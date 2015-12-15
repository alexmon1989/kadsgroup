<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactsRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Orchestra\Support\Facades\Memory;

class ContactsController extends AdminController
{
    /**
     * Отображает индексную страницу.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        // Данные
        $data['contacts_form_text'] = Article::whereType('contacts_form_text')->first();
        $data['contacts_contacts'] = Article::whereType('contacts_contacts')->first();
        $data['contacts_working_time'] = Article::whereType('contacts_working_time')->first();
        $data['contacts_why_us'] = Article::whereType('contacts_why_us')->first();

        return view('admin.contacts.index', $data);
    }

    /**
     * Обработчик запроса на сохранение данных.
     *
     * @param StoreContactsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postIndex(StoreContactsRequest $request)
    {
        // Сохраняем координаты в таблице настроек
        Memory::put('contacts.latitude', $request->get('latitude'));
        Memory::put('contacts.longitude', $request->get('longitude'));

        // Данные статей
        Model::unguard();
        $contacts_form_text = Article::firstOrNew(['type' => 'contacts_form_text']);
        $contacts_contacts = Article::firstOrNew(['type' => 'contacts_contacts']);
        $contacts_working_time = Article::firstOrNew(['type' => 'contacts_working_time']);
        $contacts_why_us = Article::firstOrNew(['type' => 'contacts_why_us']);

        // Обновляем тексты
        $contacts_form_text->full_text = $request->get('contacts_form_text');
        // настройки СЕО
        $contacts_form_text->page_title        = $request->get('page_title');
        $contacts_form_text->page_keywords     = $request->get('page_keywords');
        $contacts_form_text->page_description  = $request->get('page_description');
        $contacts_form_text->page_h1           = $request->get('page_h1');

        $contacts_contacts->full_text = $request->get('contacts_contacts');
        $contacts_working_time->full_text = $request->get('contacts_working_time');
        $contacts_why_us->full_text = $request->get('contacts_why_us');

        // Сохранение
        $contacts_form_text->save();
        $contacts_contacts->save();
        $contacts_working_time->save();
        $contacts_why_us->save();
        Model::reguard();

        return redirect()->action('Admin\ContactsController@getIndex')
            ->with('success', 'Данные успешно сохранены.');
    }
}
