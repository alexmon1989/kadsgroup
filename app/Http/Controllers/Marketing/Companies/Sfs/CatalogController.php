<?php

namespace App\Http\Controllers\Marketing\Companies\Sfs;

use App\Category;
use App\Company;
use App\GroupsCategory;
use App\ProductSfs;
use App\ProductSika;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Marketing\Companies\CatalogController as BaseCatalogController;
use Illuminate\Support\Facades\View;

class CatalogController extends BaseCatalogController
{
    // Краткий код фирмы
    protected $shortTitle = 'sfs';

    /**
     * Отображает страницу категории SFS
     *
     * @param null $categoryId
     * @return \Illuminate\View\View
     */
    public function getCategory($categoryId = NULL)
    {
        // Получаем группы категорий для фирмы "Сика" вместе с подкатегориями
        $data['group_categories'] = $this->getCategories();

        // Если категория не выбрана, то выбираем первую категорию
        if (!$categoryId && isset($data['group_categories'][0]->categories[0])) {
            if (isset($data['group_categories'][0]->categories[0]->child_categories[0])) {
                $categoryId = $data['group_categories'][0]->categories[0]
                    ->child_categories[0]
                    ->id;
            } elseif (isset($data['group_categories'][0]->categories[0]->id)) {
                $categoryId = $data['group_categories'][0]->categories[0]->id;
            } else {
                abort(404);
            }
        }

        // Категория
        $data['category'] = Category::whereEnabled(TRUE)
            ->with(['parent_category' => function ($q) {
                $q->whereEnabled(TRUE);
            }])
            ->with(['child_categories' => function ($q) {
                $q->whereEnabled(TRUE)->orderBy('order', 'asc');;
            }])
            ->with(['group_category' => function ($q) {
                $q->whereEnabled(TRUE);
            }])
            ->whereEnabled(TRUE)
            ->find($categoryId);

        if (!$data['category']) {
            abort(404);
        }

        // Если это не родительская категория, то получаем товары отдельно для погинации
        if (count($data['category']->child_categories) == 0) {
            $data['products'] = ProductSfs::whereCategoryId($categoryId)
                ->whereEnabled(TRUE)
                ->orderBy('created_at')
                ->paginate(9);
        }

        // Отображаем
        return view('marketing.companies.catalog.sfs.category', $data);
    }

    /**
     * Страница товара.
     *
     * @param $id
     * @return View
     */
    public function getShow($id)
    {
        // Получаем продукт из БД
        $data['product'] = ProductSfs::whereEnabled(TRUE)
            ->with('category')
            ->find($id);

        if (!empty($data['product']))
        {
            // Получаем группы категорий для фирмы "Sfs" вместе с подкатегориями
            $data['group_categories'] = $this->getCategories();

            // Отображаем
            return view('marketing.companies.catalog.sfs.show', $data);
        } else {
            abort(404);
        }
    }
}
