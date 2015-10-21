<?php

namespace App\Http\Controllers\Marketing\Companies;

use App\Company;
use App\Http\Controllers\Admin\AdminController;
use App\Services\SavesImages;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DescriptionsController extends AdminController
{
    /**
     * Отображает индексную страницу модуля
     *
     * @return \Illuminate\View\View
     */
    public function getShow($shortTitle)
    {
        // Ищем кфирму по короткому названию
        $data['company'] = Company::whereShortTitle($shortTitle)->first();

        if (empty($data['company'])) {
            abort(404);
        }

        return view('marketing.companies.descriptions.show', $data);
    }
}
