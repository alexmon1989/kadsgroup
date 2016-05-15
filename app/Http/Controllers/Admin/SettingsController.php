<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSettingsRequest;
use Orchestra\Support\Facades\Memory;

class SettingsController extends AdminController
{
    /**
     * Действие для отображения индексной страницы модуля.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        // Контактные данные
        Model::unguard();
        $data['main_article'] = Article::firstOrCreate(['type' => 'main_article']);
        $data['footer_about'] = Article::firstOrCreate(['type' => 'footer_about']);
        $data['footer_contacts'] = Article::firstOrCreate(['type' => 'footer_contacts']);
        Model::reguard();

        return view('admin.settings.index', $data);
    }

    /**
     * Обработчик запроса на сохранение данных.
     *
     * @param StoreSettingsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postIndex(StoreSettingsRequest $request)
    {
        // Сохраняем координаты в таблице настроек
        Memory::put('site.email_to', $request->get('email_to'));

        // JivoSite
        Memory::put('site.jivosite_enabled', $request->get('jivosite_enabled', 0));

        // Данные статей
        $mainArticle = Article::whereType('main_article')->first();
        $footerAbout = Article::whereType('footer_about')->first();
        $footerContacts = Article::whereType('footer_contacts')->first();

        // Обновляем тексты
        $mainArticle->full_text = $request->get('main_article');
        $footerAbout->full_text = $request->get('footer_about');
        $footerContacts->full_text = $request->get('footer_contacts');

        // Сохранение
        $mainArticle->save();
        $footerAbout->save();
        $footerContacts->save();

        return redirect()->back()->with('success', 'Данные успешно сохранены.');
    }
}