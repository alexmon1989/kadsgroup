<?php

namespace App\Http\Controllers\Admin\Companies\Catalog\Products;

use App\Category;
use App\Company;
use App\GroupsCategory;
use App\Http\Controllers\Admin\AdminController;
use App\ProductSika;
use App\Services\SavesImages;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
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
            ->whereHas('categories', function ($q) {
                $q->where('enabled', '=', TRUE); // Категории Sika
            })
            ->where('enabled', '=', TRUE)
            ->where('company_id', '=', 1) // Категории Sika
            ->orderBy('order')
            ->get();
        // Lazy loading для правильной сортировки по алфавиту укр. симоволов
        $data['group_categories']->load(['categories' => function ($q) {
            $q->with(['child_categories' => function($q) { $q->where('enabled', '=', TRUE); }])
                ->where('enabled', '=', TRUE)
                ->orderBy('title', 'ASC');
        }]);

        return view('admin.companies.catalog.products.sika.create', $data);
    }

    /**
     * Обработчик запроса на создание продукта.
     *
     * @param Requests\StoreProductsSikaRequest $request
     * @param SavesImages $imageSaver
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Services\Exception
     */
    public function postCreate(Requests\StoreProductsSikaRequest $request, SavesImages $imageSaver)
    {
        // Создаём продукт
        $product = new ProductSika;

        // Текстовые данные
        $product->title = trim($request->title);
        $product->description = trim($request->description);
        $product->package = trim($request->package);
        $product->package_list = trim($request->package_list);
        $product->characteristics = trim($request->characteristics);
        $product->using_area = trim($request->using_area);
        $product->category_id = $request->category_id;
        $product->enabled = $request->get('enabled', FALSE);

        // Изображение
        $product->photo = $imageSaver->save('photo', 'products/sika', 260);

        // Техкарта
        if ($request->hasFile('tech_cart_file')) {
            $generator = \Faker\Factory::create();
            $product->tech_cart_file = $generator->uuid.'.pdf';
            $request->file('tech_cart_file')->move(public_path('assets/img/products/sika/tech-carts/'), $product->tech_cart_file);
        }

        // SEO
        $product->page_title = $request->page_title;
        $product->page_keywords = $request->page_keywords;
        $product->page_description = $request->page_description;
        $product->page_h1 = $request->page_h1;


        // Сохраняем
        $product->save();

        return redirect()->action('Admin\Companies\Catalog\Products\SikaController@getEdit', ['id' => $product->id])
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
                $q->where('enabled', '=', TRUE); // Категории Sika
            })
            ->where('enabled', '=', TRUE)
            ->where('company_id', '=', 1) // Категории Sika
            ->orderBy('order')
            ->get();
        // Lazy loading для правильной сортировки по алфавиту укр. симоволов
        $data['group_categories']->load(['categories' => function ($q) {
            $q->with(['child_categories' => function($q) { $q->where('enabled', '=', TRUE); }])
                ->where('enabled', '=', TRUE)
                ->orderBy('title', 'ASC');
        }]);

        return view('admin.companies.catalog.products.sika.edit', $data);
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
        $product->title = trim($request->title);
        $product->description = trim($request->description);
        $product->package = trim($request->package);
        $product->package_list = trim($request->package_list);
        $product->characteristics = trim($request->characteristics);
        $product->using_area = trim($request->using_area);
        $product->category_id = $request->category_id;
        $product->enabled = $request->get('enabled', FALSE);

        // Изображение
        if ($request->hasFile('photo')) {
            $product->photo = $imageSaver->save('photo', 'products/sika', 260, NULL, $product->photo);
        }

        // Техкарта
        if ($request->hasFile('tech_cart_file')) {
            // Удаляем старый файл
            File::delete(public_path('assets/img/products/sika/tech-carts/'.$product->tech_cart_file));
            $generator = \Faker\Factory::create();
            $product->tech_cart_file = $generator->uuid.'.pdf';
            $request->file('tech_cart_file')->move(public_path('assets/img/products/sika/tech-carts/'), $product->tech_cart_file);
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
        $products = ProductSika::with('category.group_category')->get();

        return Datatables::of($products)
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
