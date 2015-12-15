<?php

namespace App\Http\Controllers\Marketing\Companies;

use App\Article;
use App\Http\Controllers\Admin\AdminController;
use App\Services\SavesImages;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Orchestra\Support\Facades\Memory;

class PriceListController extends AdminController
{
    /**
     * Отображает индексную страницу модуля
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        // Ищем данные прайс-листа
        $data['article'] = Article::firstOrCreate(['type' => 'price_list_description']);
        $data['file_name'] = Memory::get('price.primer.file_name');

        return view('marketing.companies.price_list.index', $data);
    }
}
