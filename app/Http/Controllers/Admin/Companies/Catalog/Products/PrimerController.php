<?php

namespace App\Http\Controllers\Admin\Companies\Catalog\Products;

use App\GroupsCategory;
use App\Http\Controllers\Admin\AdminController;
use App\ProductPrimer;
use App\Services\SavesImages;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use yajra\Datatables\Datatables;

class PrimerController extends AdminController
{
    /**
     * Отображает список товаров.
     *
     * @return Response
     */
    public function getIndex()
    {
        return view('admin.companies.catalog.products.primer.index');
    }

    /**
     * Отображает форму создания товара.
     *
     * @return \BladeView|bool|\Illuminate\View\View
     */
    public function getCreate()
    {
        // Группы категорий вместе с категориями
        $data['group_categories'] = GroupsCategory::whereEnabled(true)
            ->whereHas('categories', function ($q) {
                $q->where('enabled', '=', TRUE);
            })
            ->where('enabled', '=', TRUE)
            ->where('company_id', '=', 3) // Категории primer
            ->orderBy('order')
            ->get();
        // Lazy loading для правильной сортировки по алфавиту укр. симоволов
        $data['group_categories']->load(['categories' => function ($q) {
            $q->orderBy('title', 'ASC');
        }]);

        return view('admin.companies.catalog.products.primer.create', $data);
    }

    /**
     * Обработчик запроса на создание продукта.
     *
     * @param Requests\StoreProductsPrimerRequest $request
     * @param SavesImages $imageSaver
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Services\Exception
     */
    public function postCreate(Requests\StoreProductsPrimerRequest $request, SavesImages $imageSaver)
    {
        // Создаём продукт
        $product = new ProductPrimer;

        // Текстовые данные
        $product->title                     = trim($request->title);
        $product->category_id               = $request->category_id;
        $product->package                   = trim($request->package);
        $product->description_small         = trim($request->description_small);
        $product->description_full          = trim($request->description_full);
        $product->using                     = trim($request->using);
        $product->tech_characteristics      = trim($request->tech_characteristics);
        $product->exec_works                = trim($request->exec_works);
        $product->application               = trim($request->application);
        $product->properties_using          = trim($request->properties_using);
        $product->phys_chem_properties      = trim($request->phys_chem_properties);
        $product->restrictions              = trim($request->restrictions);
        $product->safety                    = trim($request->safety);
        $product->general_characteristics   = trim($request->general_characteristics);
        $product->price_1_name              = trim($request->price_1_name);
        $product->price_1_val               = trim($request->price_1_val);
        $product->price_2_name              = trim($request->price_2_name);
        $product->price_2_val               = trim($request->price_2_val);
        $product->price_3_name              = trim($request->price_3_name);
        $product->price_3_val               = trim($request->price_3_val);
        $product->price_4_name              = trim($request->price_4_name);
        $product->price_4_val               = trim($request->price_4_val);
        $product->enabled                   = $request->get('enabled', FALSE);

        // Изображение
        $product->photo = $imageSaver->save('photo', 'products/primer', 260);

        // SEO
        $product->page_title = $request->page_title;
        $product->page_keywords = $request->page_keywords;
        $product->page_description = $request->page_description;
        $product->page_h1 = $request->page_h1;

        // Сохраняем
        $product->save();

        return redirect()->action('Admin\Companies\Catalog\Products\PrimerController@getEdit', ['id' => $product->id])
            ->with('success', 'Продукт успешно сохранён.');
    }

    /**
     * Действие для отображения страницы редактирования товара.
     *
     * @param $id
     * @return \BladeView|bool|\Illuminate\View\View
     */
    public function getEdit($id)
    {
        // Ищем товар
        $data['product'] = $this->findProduct($id);

        // Группы категорий вместе с категориями
        $data['group_categories'] = GroupsCategory::whereEnabled(true)
            ->whereHas('categories', function ($q) {
                $q->where('enabled', '=', TRUE);
            })
            ->where('enabled', '=', TRUE)
            ->where('company_id', '=', 3) // Категории primer
            ->orderBy('order')
            ->get();
        // Lazy loading для правильной сортировки по алфавиту укр. симоволов
        $data['group_categories']->load(['categories' => function ($q) {
            $q->orderBy('title', 'ASC');
        }]);

        return view('admin.companies.catalog.products.primer.edit', $data);
    }

    /**
     * Действие для редктирования продукта.
     *
     * @param Requests\StoreProductsSikaRequest $request
     * @param SavesImages $imageSaver
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(Requests\StoreProductsSikaRequest $request, SavesImages $imageSaver, $id)
    {
        $product = $this->findProduct($id);

        // Текстовые данные
        $product->title                     = trim($request->title);
        $product->category_id               = $request->category_id;
        $product->package                   = trim($request->package);
        $product->description_small         = trim($request->description_small);
        $product->description_full          = trim($request->description_full);
        $product->using                     = trim($request->using);
        $product->tech_characteristics      = trim($request->tech_characteristics);
        $product->exec_works                = trim($request->exec_works);
        $product->application               = trim($request->application);
        $product->properties_using          = trim($request->properties_using);
        $product->phys_chem_properties      = trim($request->phys_chem_properties);
        $product->restrictions              = trim($request->restrictions);
        $product->safety                    = trim($request->safety);
        $product->general_characteristics   = trim($request->general_characteristics);
        $product->price_1_name              = trim($request->price_1_name);
        $product->price_1_val               = trim($request->price_1_val);
        $product->price_2_name              = trim($request->price_2_name);
        $product->price_2_val               = trim($request->price_2_val);
        $product->price_3_name              = trim($request->price_3_name);
        $product->price_3_val               = trim($request->price_3_val);
        $product->price_4_name              = trim($request->price_4_name);
        $product->price_4_val               = trim($request->price_4_val);
        $product->enabled                   = $request->get('enabled', FALSE);


        // Изображение
        if ($request->hasFile('photo')) {
            $product->photo = $imageSaver->save('photo', 'products/primer', 260, NULL, $product->photo);
        }

        // SEO
        $product->page_title = $request->page_title;
        $product->page_keywords = $request->page_keywords;
        $product->page_description = $request->page_description;
        $product->page_h1 = $request->page_h1;

        // Сохраняем
        $product->save();

        // Возвращаем назад с успехом
        return redirect()->back()->with('success', 'Продукт успешно сохранён.');
    }

    /**
     * Действие для удаления продукта.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($id)
    {
        $product = $this->findProduct($id);
        $product->delete();

        // ВНИМАНИЕ! Изображение удаляется в EventServiceProvider (событийно)

        return redirect()->back()->with('success', 'Продукт успешно удален.');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $products = ProductPrimer::with('category')->get();

        return Datatables::of($products)
            ->addColumn('category', function ($item) {
                $s =  $item->category->title;
                return $s;
            })
            ->addColumn('action', function ($item) {
                $s =  '<a class="btn btn-primary btn-sm" href="'.action('Admin\Companies\Catalog\Products\PrimerController@getEdit', ['id' => $item->id]).'" title="Редактировать"><i class="fa fa-edit"></i></a>';
                $s .= '<a class="btn btn-danger btn-sm item-delete" href="'.action('Admin\Companies\Catalog\Products\PrimerController@getDelete', ['id' => $item->id]).'" title="Удалить"><i class="fa fa-remove"></i></a>';
                return $s;
            })
            ->addColumn('enabled', function ($item) {
                $s =  $item->enabled ? '<strong>Да</strong>' : 'Нет';
                return $s;
            })
            ->make(true);
    }

    /**
     * Поиск товара в БД по ид или переадресация на 404
     *
     * @param $id
     * @return \Illuminate\Support\Collection|null|static
     */
    private function findProduct($id)
    {
        // Ищем товар
        $product = ProductPrimer::find($id);
        if (empty($product))
        {
            abort(404);
        }
        return $product;
    }
}
