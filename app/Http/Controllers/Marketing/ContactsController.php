<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article;
use App\Http\Requests\ContactsMessageRequest;
use Illuminate\Support\Facades\Mail;
use Orchestra\Support\Facades\Memory;

class ContactsController extends Controller {
    /**
     * Отображение страницы "Контакты"
     *
     * @return Response
     */
    public function getIndex()
    {
        // Контактные данные
        $data['contacts_form_text'] = Article::firstOrCreate(['type' => 'contacts_form_text']);
        $data['contacts_contacts'] = Article::firstOrCreate(['type' => 'contacts_contacts']);
        $data['contacts_working_time'] = Article::firstOrCreate(['type' => 'contacts_working_time']);
        $data['contacts_why_us'] = Article::firstOrCreate(['type' => 'contacts_why_us']);

        return view('marketing.contacts.index', $data);
    }

    /**
     * Обработчик запроса на отправку сообщения
     *
     * @param ContactsMessageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postIndex(ContactsMessageRequest $request)
    {
        // Отправляем сообщение на email
        Mail::send('emails.contacts', [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'message_text' => nl2br($request->get('message')),
        ], function($message)
        {
            $message->from('info@kadsgroup.com.ua');
            $message->to(Memory::get('site.email_to', 'llckadsgroup@gmail.com'))
                ->subject('Сообщение пользователя сайта kadsgroup.com.ua');
        });

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        } else {
            return redirect()->action('Marketing\ContactsController@getIndex')
                ->with('success', 'Спасибо, сообщение успешно отправлено. Наши менеджеры ответят на него в ближайшее время!');
        }
    }
}