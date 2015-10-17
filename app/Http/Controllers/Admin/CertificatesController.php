<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Certificate;
use App\Services\SavesImages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\StoreCertificatesSettingsRequest;
use App\Http\Requests\StoreCertificatesRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CertificatesController extends AdminController
{
    /**
     * Отображает индексную страницу модуля.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        // Сертификаты
        $data['certificates'] = Certificate::orderBy('created_at', 'DESC')->get();

        return view('admin.certificates.index', $data);
    }

    /**
     * Действие для отображения страницы настроек модуля.
     *
     * @return \Illuminate\View\View
     */
    public function getSettings()
    {
        // Статья с описанием сертификатов
        Model::unguard();
        $data['certificates_description'] = Article::firstOrCreate(['type' => 'certificates_description']);
        Model::reguard();

        return view('admin.certificates.settings', $data);
    }

    /**
     * Действие-обработчик сохранение настроек модуля
     *
     * @param StoreCertificatesSettingsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSettings(StoreCertificatesSettingsRequest $request)
    {
        // Изменяем статью
        $article = Article::whereType('certificates_description')->first();
        $article->title = $request->get('title');
        $article->full_text = $request->get('full_text');
        $article->save();

        return redirect()->back()->with('success', 'Данные успешно сохранены.');
    }

    /**
     * Действие для отображения страницы создания сертификата
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        return view('admin.certificates.add');
    }

    /**
     * Действие-обработчик запроса на сохранение сертификата.
     *
     * @param StoreCertificatesRequest $request
     * @param SavesImages $imageSaver
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Services\Exception
     */
    public function postCreate(StoreCertificatesRequest $request, SavesImages $imageSaver)
    {
        $certificate = new Certificate;
        $certificate->title = trim($request->title);
        $certificate->file_name = $imageSaver->save('file_name', 'certificates', 630);
        $certificate->save();

        return redirect()->action('Admin\CertificatesController@getEdit', array('id' => $certificate->id))
            ->with('success', 'Сертификат успешно сохранен.');
    }

    /**
     * Действие для отображения страницы редактирования сертификата.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        $data['certificate'] = Certificate::find($id);

        if (empty($data['certificate'])) {
            abort(404);
        }

        return view('admin.certificates.edit', $data);
    }

    /**
     * Действие-обработчик запроса на редактирование сертификата
     *
     * @param StoreCertificatesRequest $request
     * @param SavesImages $imageSaver
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Services\Exception
     */
    public function postEdit(StoreCertificatesRequest $request, SavesImages $imageSaver, $id)
    {
        $certificate = Certificate::find($id);

        if (empty($certificate)) {
            abort(404);
        }

        // Меняем данные и сохраняем
        $certificate->title = trim($request->title);
        if ($request->hasFile('file_name'))
        {
            $certificate->file_name = $imageSaver->save('file_name', 'certificates', 630, NULL, $certificate->file_name);
        }
        $certificate->save();

        return redirect()->action('Admin\CertificatesController@getEdit', array('id' => $id))
            ->with('success', 'Сертификат успешно сохранен.');
    }

    /**
     * Удаление сертификата.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($id)
    {
        $certificate = Certificate::find($id);

        if (empty($certificate)) {
            abort(404);
        }

        // Удаляем изображение
        File::delete(public_path('assets' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR .
            'certificates' . DIRECTORY_SEPARATOR . $certificate->file_name));

        $certificate->delete();

        return redirect()->action('Admin\CertificatesController@getIndex')
            ->with('success', 'Сертификат успешно удален.');
    }


}
