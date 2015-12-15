<?php

namespace App\Http\Controllers\Admin\Companies\Catalog;

use App\Company;
use App\GroupsCategory;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GroupsCategoriesController extends AdminController
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
     * Отображает список групп категорий.
     *
     * @return Response
     */
    public function getIndex()
    {
        // Ищем фирму по короткому названию
        $data['company'] = Company::whereShortTitle($this->companyName)->first();

        // Получаем список групп категорий
        $data['groups_categories'] = GroupsCategory::whereHas('company', function ($query) {
            $query->where('short_title', '=', $this->companyName);
        })->get();

        return view('admin.companies.catalog.groups_categories.index', $data);
    }

    /**
     * Страница создания группы категорий.
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        // Ищем фирму по короткому названию
        $data['company'] = Company::whereShortTitle($this->companyName)->first();

        return view('admin.companies.catalog.groups_categories.create', $data);
    }

    /**
     * Обработчик запроса на создание группы категорий.
     *
     * @param Requests\StoreGroupsCategoriesRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(Requests\StoreGroupsCategoriesRequest $request)
    {
        // Компания, для которой создаётся группа
        $company = Company::whereShortTitle($this->companyName)->first();

        // Создаём группу
        $groupCategory = new GroupsCategory;
        $groupCategory->title = trim($request->title);
        $groupCategory->description = trim($request->description);
        $groupCategory->enabled = $request->get('enabled', FALSE);
        $groupCategory->company_id = $company->id;
        $groupCategory->order = GroupsCategory::whereCompanyId($groupCategory->company_id)->max('order') + 1;
        // SEO
        $groupCategory->page_title = $request->page_title;
        $groupCategory->page_keywords = $request->page_keywords;
        $groupCategory->page_description = $request->page_description;
        $groupCategory->page_h1 = $request->page_h1;
        $groupCategory->save();

        return redirect('admin/companies/catalog/groups-categories/edit/'.$groupCategory->id.'?company='.$company->short_title)
            ->with('success', 'Группа категорий успешно создана.');
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

        // Ищем группу
        $data['group_category'] = $this->findGroupCategory($id);

        return view('admin.companies.catalog.groups_categories.edit', $data);
    }

    /**
     * Дейстиве для редактированя группы категорий.
     *
     * @param Requests\StoreGroupsCategoriesRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(Requests\StoreGroupsCategoriesRequest $request, $id)
    {
        // Ищем и редактируем группу
        $groupCategory = $this->findGroupCategory($id);
        $groupCategory->title = trim($request->title);
        $groupCategory->description = trim($request->description);
        $groupCategory->enabled = $request->get('enabled', FALSE);
        // SEO
        $groupCategory->page_title = $request->page_title;
        $groupCategory->page_keywords = $request->page_keywords;
        $groupCategory->page_description = $request->page_description;
        $groupCategory->page_h1 = $request->page_h1;
        $groupCategory->save();

        return redirect()->back()->with('success', 'Группа категорий успешно отредактирована.');
    }

    /**
     * Действие для удаления группы категорий.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($id)
    {
        // Ищем группу
        $groupCategory = $this->findGroupCategory($id);
        if (count($groupCategory->categories) == 0) {
            // Всем группам после этой уменьшаем позицию
            $groups = GroupsCategory::whereCompanyId($groupCategory->company_id)->where('order', '>', $groupCategory->order)->get();
            foreach ($groups as $item) {
                $item->order -= 1;
                $item->save();
            }
            $groupCategory->delete();

            return redirect()->back()->with('success', 'Группа категорий успешно удалена.');
        } else {
            return redirect()->back()->with('errors', 'Группа категорий не может быть удалена, т.к. содержит категории.');
        }
    }

    /**
     * Увеличение позиции группы категорий.
     *
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function getIncreasePosition($id)
    {
        // Ищем группу
        $groupCategory = $this->findGroupCategory($id);
        // Группе после - ставим позицию текущей группы, а сначала ищем её
        $orderNext = $groupCategory->order + 1;
        $groupCategoryNext = GroupsCategory::whereCompanyId($groupCategory->company_id)->where('order', '=', $orderNext)->first();
        // Если она существует, то делаем изменения, если нет - это последняя группа, изменения невозможны
        if ($groupCategoryNext)
        {
            $groupCategoryNext->order = $groupCategory->order;
            $groupCategoryNext->save();
            $groupCategory->order = $orderNext;
            $groupCategory->save();
            return redirect()->back()->with('success', 'Порядок успешно изменён.');
        }
        return redirect()->back()->withErrors('Порядок не может быть изменён, это и так последняя группа категорий.');
    }

    /**
     * Уменьшение позиции группы категорий.
     *
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function getDecreasePosition($id)
    {
        // Ищем группу
        $groupCategory = $this->findGroupCategory($id);
        // Группе перед - ставим позицию текущей группы, а сначала ищем её
        $orderPrev = $groupCategory->order - 1;
        $groupCategoryPrev = GroupsCategory::whereCompanyId($groupCategory->company_id)->where('order', '=', $orderPrev)->first();
        // Если она существует, то делаем изменения, если нет - это последняя группа, изменения невозможны
        if ($groupCategoryPrev)
        {
            $groupCategoryPrev->order = $groupCategory->order;
            $groupCategoryPrev->save();
            $groupCategory->order = $orderPrev;
            $groupCategory->save();
            return redirect()->back()->with('success', 'Порядок успешно изменён.');
        }
        return redirect()->back()->withErrors('Порядок не может быть изменён, это и так первая группа категорий.');
    }

    /**
     * Поиск группы категорий в БД по ид или переадресация на 404
     *
     * @param $id
     * @return \Illuminate\Support\Collection|null|static
     */
    private function findGroupCategory($id)
    {
        // Ищем
        $groupCategory = GroupsCategory::whereHas('company', function ($query) {
            $query->where('short_title', '=', $this->companyName);
        })->find($id);
        if (empty($groupCategory)) {
            abort(404);
        }
        return $groupCategory;
    }
}
