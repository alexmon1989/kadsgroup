<?php

namespace App\Http\Controllers\Admin\Companies;

use App\Company;
use App\Http\Controllers\Admin\AdminController;
use App\Services\SavesImages;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\StoreCompanyDescriptionsRequest;
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
        // Ищем кфирму по короткому названию
        $data['company'] = Company::whereShortTitle($this->companyName)->first();

        if (empty($data['company'])) {
            abort(404);
        }

        return view('admin.companies.descriptions.index', $data);
    }

    /**
     * @param StoreCompanyDescriptionsRequest $request
     * @param SavesImages $imageSaver
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Services\Exception
     */
    public function postIndex(StoreCompanyDescriptionsRequest $request, SavesImages $imageSaver)
    {
        // Ищем кфирму по короткому названию
        $company = Company::whereShortTitle($this->companyName)->first();

        if (empty($company)) {
            abort(404);
        }

        // Меняем данные
        $company->title = trim($request->title);
        $company->description = trim($request->description);
        if ($request->hasFile('file_main'))
        {
            $company->file_main = $imageSaver->save('file_main', 'companies', 370, 247, $company->file_main);
        }
        if ($request->hasFile('file_logo'))
        {
            $company->file_logo = $imageSaver->save('file_logo', 'companies'.DIRECTORY_SEPARATOR.'top', NULL, 89, $company->file_logo);
        }
        $company->page_title = trim($request->page_title);
        $company->page_keywords = trim($request->page_keywords);
        $company->page_description = trim($request->page_description);
        $company->page_h1 = trim($request->page_h1);
        $company->save();

        return redirect()->back()->with('success', 'Описание успешно сохранено.');
    }
}
