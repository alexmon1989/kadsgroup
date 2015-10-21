<?php

namespace App\Http\Controllers\Admin\Companies;

use App\Company;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DescriptionsController extends AdminController
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
     * Отображает индексную страницу модуля
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $data['company'] = Company::whereShortTitle($this->companyName)->first(['title']);

        if (empty($data['company'])) {
            abort(404);
        }

        return view('admin.companies.descriptions.index', $data);
    }
}
