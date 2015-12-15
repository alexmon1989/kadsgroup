<?php

namespace App\Http\Controllers\Admin\Companies\Catalog;

use App\Category;
use App\Company;
use App\GroupsCategory;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoriesController extends AdminController
{
    private $companyName;

    public function __construct(Request $request)
    {
        parent::__construct();

        // С какой фирмой работаем
        $this->companyName = $request->get('company');
        if (!in_array($this->companyName, ['sika', 'sfs', 'primer'])) {
            abort(404);
        }
    }

    /**
     * Отображает список категорий.
     *
     * @return Response
     */
    public function getIndex()
    {
        // Ищем фирму по короткому названию
        $data['company'] = Company::whereShortTitle($this->companyName)->first();

        // Получаем список групп категорий
        $data['categories'] = Category::with('group_category')
            ->with('parent_category')
            ->whereHas('group_category', function ($query) use ($data) {
                $query->where('company_id', '=', $data['company']->id);
            })->get();

        return view('admin.companies.catalog.categories.index', $data);
    }

    /**
     * Страница создания категории.
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        // Ищем фирму по короткому названию
        $data['company'] = Company::whereShortTitle($this->companyName)->first();

        // Возможные родительские категории
        $data['parent_categories'] = Category::whereNull('parent_id')->orderBy('title')->get();

        // Группы категорий
        $data['groups_categories'] = GroupsCategory::whereCompanyId($data['company']->id)->orderBy('title')->get();

        return view('admin.companies.catalog.categories.create', $data);
    }

    /**
     * Обработчик запроча на создание категории.
     *
     * @param Requests\StoreCategoriesRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Requests\StoreCategoriesRequest $request)
    {
        // Создаём категорию
        $category = new Category;
        $category->title = trim($request->title);
        $category->description = trim($request->description);
        $category->enabled = $request->get('enabled', FALSE);
        if ($request->get('parent_id')) {
            $category->parent_id = (int) $request->get('parent_id');
        }
        $category->group_category_id = $request->group_category_id;

        // Порядок
        $category->order = Category::whereGroupCategoryId($category->group_category_id);
        // Есть ли родители или нет
        if ($category->parent_id) {
            $category->order->where('parent_id', '=', $category->parent_id);
        } else {
            $category->order->whereNull('parent_id');
        }
        $category->order =  $category->order->max('order') + 1;

        // SEO
        $category->page_title = $request->page_title;
        $category->page_keywords = $request->page_keywords;
        $category->page_description = $request->page_description;
        $category->page_h1 = $request->page_h1;

        // Сохранение
        $category->save();

        return redirect('admin/companies/catalog/categories/edit/'.$category->id.'?company='.$this->companyName)
            ->with('success', 'Категория успешно создана.');
    }

    /**
     * Страница редактирования группы категорий.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        // Ищем фирму по короткому названию
        $data['company'] = Company::whereShortTitle($this->companyName)->first();

        // Ищем категорию
        $data['category'] = $this->findCategory($id);

        // Группы категорий
        $data['groups_categories'] = GroupsCategory::whereCompanyId($data['company']->id)->orderBy('title')->get();

        return view('admin.companies.catalog.categories.edit', $data);
    }

    /**
     * Дейстиве для редактированя категорий.
     *
     * @param Requests\StoreGroupsCategoriesRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(Requests\StoreGroupsCategoriesRequest $request, $id)
    {
        // Ищем и редактируем категорию
        $category = $this->findCategory($id);
        $category->title = trim($request->title);
        $category->description = trim($request->description);
        $category->enabled = $request->get('enabled', FALSE);
        $oldGroupCategoryId = $category->group_category_id;
        $oldParentId = $category->parent_id;
        if ($request->get('group_category_id') != '') {
            $category->group_category_id = (int) $request->get('group_category_id');
        }
        if ($request->get('parent_id') != '') {
            $category->parent_id = (int) $request->get('parent_id');
        } else {
            $category->parent_id = NULL;
        }

        // Менять ли порядок
        if ($oldGroupCategoryId != $request->get('group_category_id', $oldGroupCategoryId) || $oldParentId != $request->get('parent_id', $oldParentId)) {
            // Изем категории со "старыми" group_category_id и parent_id
            $categories = Category::whereGroupCategoryId($oldGroupCategoryId)
                ->where('order', '>', $category->order);
            // Есть ли родители или нет
            if ($oldParentId) {
                $categories->where('parent_id', '=', $oldParentId);
            } else {
                $categories->whereNull('parent_id');
            }
            $categories = $categories->get();

            // Уменьшаем порядок
            foreach($categories as $item)
            {
                $item->order -= 1;
                $item->save();
            }

            // Меняем порядок данной категории
            $category->order = Category::whereGroupCategoryId($category->group_category_id);
            // Есть ли родители или нет
            if ($category->parent_id) {
                $category->order->where('parent_id', '=', $category->parent_id);
            } else {
                $category->order->whereNull('parent_id');
            }
            $category->order =  $category->order->max('order') + 1;
        }

        // SEO
        $category->page_title = $request->page_title;
        $category->page_keywords = $request->page_keywords;
        $category->page_description = $request->page_description;
        $category->page_h1 = $request->page_h1;

        // Сохранение
        $category->save();

        return redirect()->back()->with('success', 'Категория успешно отредактирована.');
    }

    /**
     * Действие для удаления категорий.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($id)
    {
        // Ищем категорию
        $category = $this->findCategory($id);

        // Разрешаем удалять только если нет дочерних категорий
        if (count($category->child_categories) == 0 && count($category->products_sika) == 0) {

            // Всем категориям после этой уменьшаем позицию
            $categories = Category::whereGroupCategoryId($category->group_category_id)
                ->where('order', '>', $category->order);
            // Есть ли родители или нет
            if ($category->parent_id) {
                $categories->where('parent_id', '=', $category->parent_id);
            } else {
                $categories->whereNull('parent_id');
            }
            $categories = $categories->get();

            foreach ($categories as $item) {
                $item->order -= 1;
                $item->save();
            }
            $category->delete();

            return redirect()->back()->with('success', 'Категория успешно удалена.');

        } else {
            return redirect()->back()->with('errors', 'Категория не может быть удалена, т.к. содержит дочерние категории или товары.');
        }
    }

    /**
     * Увеличение позиции категории.
     *
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function getIncreasePosition($id)
    {
        // Ищем категорию
        $category = $this->findCategory($id);
        // Категории после - ставим позицию текущей категории, а сначала ищем её
        $orderNext = $category->order + 1;
        $categoryNext = Category::whereGroupCategoryId($category->group_category_id)
            ->where('order', '=', $orderNext);
        // Есть ли родители или нет
        if ($category->parent_id) {
            $categoryNext->where('parent_id', '=', $category->parent_id);
        } else {
            $categoryNext->whereNull('parent_id');
        }
        $categoryNext = $categoryNext->first();

        // Если она существует, то делаем изменения, если нет - это последняя группа, изменения невозможны
        if ($categoryNext)
        {
            $categoryNext->order = $category->order;
            $categoryNext->save();
            $category->order = $orderNext;
            $category->save();
            return redirect()->back()->with('success', 'Порядок успешно изменён.');
        }
        return redirect()->back()->withErrors('Порядок не может быть изменён, это и так последняя категория.');
    }

    /**
     * Уменьшение позиции категории.
     *
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function getDecreasePosition($id)
    {
        // Ищем группу
        $category = $this->findCategory($id);
        // Категории перед - ставим позицию текущей Категории, а сначала ищем её
        $orderPrev = $category->order - 1;
        $categoryPrev = Category::whereGroupCategoryId($category->group_category_id)
            ->where('order', '=', $orderPrev);
        // Есть ли родители или нет
        if ($category->parent_id) {
            $categoryPrev->where('parent_id', '=', $category->parent_id);
        } else {
            $categoryPrev->whereNull('parent_id');
        }
        $categoryPrev = $categoryPrev->first();

        // Если она существует, то делаем изменения, если нет - это последняя группа, изменения невозможны
        if ($categoryPrev)
        {
            $categoryPrev->order = $category->order;
            $categoryPrev->save();
            $category->order = $orderPrev;
            $category->save();
            return redirect()->back()->with('success', 'Порядок успешно изменён.');
        }
        return redirect()->back()->withErrors('Порядок не может быть изменён, это и так первая категория.');
    }

    /**
     * Получение родительских категорий конкретной группы категорий
     *
     * @param $groupCategoryId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getParentCategories($groupCategoryId, $ignoreId = NULL)
    {
        $categories = Category::whereGroupCategoryId($groupCategoryId)
            ->whereNull('parent_id')
            ->orderBy('title');

        if ($ignoreId) {
            $categories->where('id', '<>', $ignoreId);
        }

        $categories = $categories->get(['id', 'title']);

        return response()->json($categories);
    }


    /**
     * Поиск категории в БД по ид или переадресация на 404
     *
     * @param $id
     * @return \Illuminate\Support\Collection|null|static
     */
    private function findCategory($id)
    {
        // Ищем
        $category = Category::find($id);
        if (empty($category)) {
            abort(404);
        }
        return $category;
    }
}
