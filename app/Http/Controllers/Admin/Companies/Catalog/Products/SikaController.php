<?php

namespace App\Http\Controllers\Admin\Companies\Catalog\Products;

use App\Category;
use App\Company;
use App\GroupsCategory;
use App\Http\Controllers\Admin\AdminController;
use App\ProductSika;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use yajra\Datatables\Datatables;

class SikaController extends AdminController
{
    /**
     * Отображает список товаров.
     *
     * @return Response
     */
    public function getIndex()
    {
        return view('admin.companies.catalog.products.sika.index');
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
            ->with(['categories' => function ($q) {
                $q->with('child_categories');
            }])
            ->whereHas('categories', function ($q) {
                $q->where('enabled', '=', TRUE); // Категории Sika
            })
            ->where('enabled', '=', TRUE)
            ->orderBy('order')
            ->get();

        return view('admin.companies.catalog.products.sika.create', $data);
    }

    public function postCreate(Requests\StoreProductsSikaRequest $request)
    {

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
            ->with(['categories' => function ($q) {
                $q->with('child_categories');
            }])
            ->whereHas('categories', function ($q) {
                $q->where('enabled', '=', TRUE); // Категории Sika
            })
            ->where('enabled', '=', TRUE)
            ->orderBy('order')
            ->get();

        return view('admin.companies.catalog.products.sika.edit', $data);
    }

    public function postEdit($id)
    {

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

        // ВНИМАНИЕ! Изображение и техкарта удаляются в EventServiceProvider (событийно)

        return redirect()->back()->with('success', 'Продукт успешно удален.');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $products = ProductSika::with('category')->get();

        return Datatables::of($products)
            ->addColumn('category', function ($item) {
                $s =  $item->category->title;
                return $s;
            })
            ->addColumn('action', function ($item) {
                $s =  '<a class="btn btn-primary btn-sm" href="'.action('Admin\Companies\Catalog\Products\SikaController@getEdit', ['id' => $item->id]).'" title="Редактировать"><i class="fa fa-edit"></i></a>';
                $s .= '<a class="btn btn-danger btn-sm item-delete" href="'.action('Admin\Companies\Catalog\Products\SikaController@getDelete', ['id' => $item->id]).'" title="Удалить"><i class="fa fa-remove"></i></a>';
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
        $product = ProductSika::find($id);
        if (empty($product))
        {
            abort(404);
        }
        return $product;
    }
}
