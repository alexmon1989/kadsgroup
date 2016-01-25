<?php

namespace App\Http\Controllers\Admin\Companies\Catalog;

use App\Article;
use App\Company;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SettingsController extends AdminController
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
     * Отображает интдексную страницу.
     *
     * @return Response
     */
    public function getIndex()
    {
        // Ищем фирму по короткому названию
        $data['company'] = Company::whereShortTitle($this->companyName)->first();

        // Статья
        Model::unguard();
        $data['catalog_description'] = Article::firstOrCreate(['type' => $this->companyName . '_catalog_description']);
        Model::reguard();

        return view('admin.companies.catalog.settings.index', $data);
    }

    /**
     * Обработчик запроса на редактирование настроек
     *
     * @return Response
     */
    public function postIndex(Requests\StoreCatalogSettingsRequest $request)
    {
        $settings =  Article::firstOrCreate(['type' => $this->companyName . '_catalog_description']);

        // Меняем данные и сохраняем
        $settings->full_text                = trim($request->get('full_text'));
        $settings->page_title               = trim($request->get('page_title'));
        $settings->page_keywords            = trim($request->get('page_keywords'));
        $settings->page_description         = trim($request->get('page_description'));
        $settings->page_h1                  = trim($request->get('page_h1'));
        $settings->save();

        return redirect()->back()
            ->with('success', 'Настройки успешно сохранены.');
    }
}
