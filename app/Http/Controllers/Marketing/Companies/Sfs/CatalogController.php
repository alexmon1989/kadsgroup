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
     * Отображает страницу каталога Sika
     *
     * @param null $categoryId
     * @return \Illuminate\View\View
     */
    public function getIndex($categoryId = NULL)
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

        // Категория вместе с товарами
        $data['category'] = Category::whereEnabled(TRUE)
            ->with(['parent_category' => function ($q) {
                $q->whereEnabled(TRUE);
            }])
            ->whereEnabled(TRUE)
            ->find($categoryId);

        if (!$data['category']) {
            abort(404);
        }

        // Получаем товары отдельно для погинации
        $data['products'] = ProductSfs::whereCategoryId($categoryId)
            ->whereEnabled(TRUE)
            ->orderBy('created_at')
            ->paginate(9);

        // Отображаем
        return view('marketing.companies.catalog.sfs.index', $data);
    }

    /**
     * Страница товара.
     *
     * @param $id
     * @return View
     */
    public function getShow($id)
    {
        // Для этого каталога нет страницы товара
        abort(404);
    }
}
