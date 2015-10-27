<?php

namespace App\Http\Controllers\Marketing\Companies\Sika;

use App\Category;
use App\Company;
use App\GroupsCategory;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Marketing\Companies\CatalogController as BaseCatalogController;
use Illuminate\Support\Facades\View;

class CatalogController extends BaseCatalogController
{
    // Краткий код фирмы
    protected $shortTitle = 'sika';

    /**
     * Отображает страницу каталога Sika
     *
     * @param null $categoryId
     * @return \Illuminate\View\View
     */
    public function getIndex($categoryId = NULL)
    {
        // Получаем группы категорий для фирмы "Сика" вместе с подкатегориями
        $data['group_categories'] = GroupsCategory::whereEnabled(TRUE)
            ->orderBy('order', 'ASC')
            ->with(['categories' => function ($q) {
                $q->whereNull('parent_id')
                  ->where('enabled', '=', TRUE)
                    ->orderBy('order', 'asc')
                    ->with('child_categories');
            }])
            ->whereHas('company', function($query) {
                $query->where('short_title', '=', $this->shortTitle);
            })
            ->get();

        // Если категория не выбрана, то выбираем первую категорию
        if (!$categoryId && isset($data['group_categories'][0]->categories[0]->id)) {
            $categoryId = $data['group_categories'][0]->categories[0]
                                                    ->child_categories[0]
                                                    ->id;
        }

        // Категория вместе с товарами
        $data['category'] = Category::whereEnabled(TRUE)
            ->has('parent_category')
            ->with('parent_category')
            ->find($categoryId);

        if (!$data['category']) {
            abort(404);
        }

        // Отображаем
        return view('marketing.companies.catalog.sika.index', $data);
    }
}
