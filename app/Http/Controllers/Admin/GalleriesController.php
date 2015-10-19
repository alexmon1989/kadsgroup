<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Certificate;
use App\Company;
use App\Gallery;
use App\Services\SavesImages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\StoreGalleriesSettingsRequest;
use App\Http\Requests\StoreGalleriesRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class GalleriesController extends AdminController
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
     * Отображает индексную страницу модуля.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        // Фотографии
        $data['photos'] = Gallery::whereHas('company', function($q)
        {
            $q->where('short_title', '=', $this->companyName);
        })->get();

        $data['companyName'] = Company::whereShortTitle($this->companyName)
            ->first(['title'])
            ->title;
        $data['companyNameShort'] = $this->companyName;

        return view('admin.galleries.index', $data);
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
        $data['article'] = Article::firstOrCreate(['type' => 'gallery_'.$this->companyName.'_description']);
        Model::reguard();

        $data['companyName'] = Company::whereShortTitle($this->companyName)
            ->first(['title'])
            ->title;
        $data['companyNameShort'] = $this->companyName;

        return view('admin.galleries.settings', $data);
    }

    /**
     * Действие-обработчик сохранение настроек модуля
     *
     * @param StoreGalleriesSettingsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSettings(StoreGalleriesSettingsRequest $request)
    {
        // Изменяем статью
        $article = Article::whereType('gallery_'.$this->companyName.'_description')->first();
        $article->title = $request->get('title');
        $article->full_text = $request->get('full_text');
        $article->save();

        return redirect()->back()->with('success', 'Данные успешно сохранены.');
    }

    /**
     * Действие для отображения страницы создания фотографии
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        $data['companyName'] = Company::whereShortTitle($this->companyName)
            ->first(['title'])
            ->title;
        $data['companyNameShort'] = $this->companyName;

        return view('admin.galleries.add', $data);
    }

    /**
     * Действие-обработчик запроса на сохранение фотографии.
     *
     * @param StoreGalleriesRequest $request
     * @param SavesImages $imageSaver
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Services\Exception
     */
    public function postCreate(StoreGalleriesRequest $request, SavesImages $imageSaver)
    {
        $photo = new Gallery;
        $photo->title = trim($request->title);
        $photo->file_name = $imageSaver->save('file_name', 'galleries', 973);
        $photo->company_id = Company::whereShortTitle($request->company)->first(['id'])->id;

        // Если выбрано как главное
        if ($request->is_main == 1) {
            // Ищем фотографию с is_main = 1 и этим company_id
            $photoMain = Gallery::whereIsMain(TRUE)
                ->whereCompanyId($photo->company_id)
                ->first();
            if ($photoMain) {
                $photoMain->is_main = FALSE;
                $photoMain->save();
            }
        }
        $photo->is_main = $request->is_main;

        $photo->save();

        return redirect('admin/galleries/edit/'.$photo->id.'?company='.$request->company)
            ->with('success', 'Сертификат успешно сохранен.');
    }

    /**
     * Действие для отображения страницы редактирования фотографии.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function getEdit(Request $request, $id)
    {
        $data['photo'] = Gallery::whereHas('company', function($q) use ($request)
        {
            $q->where('short_title', '=', $request->company);
        })->find($id);

        if (empty($data['photo'])) {
            abort(404);
        }

        return view('admin.galleries.edit', $data);
    }

    /**
     * Действие-обработчик запроса на редактирование фотографии.
     *
     * @param StoreGalleriesRequest $request
     * @param SavesImages $imageSaver
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Services\Exception
     */
    public function postEdit(StoreGalleriesRequest $request, SavesImages $imageSaver, $id)
    {
        $photo = Gallery::whereHas('company', function($q) use ($request)
        {
            $q->where('short_title', '=', $request->company);
        })->find($id);

        if (empty($photo)) {
            abort(404);
        }

        // Меняем данные и сохраняем
        $photo->title = trim($request->title);
        $photo->company_id = Company::whereShortTitle($request->company)->first(['id'])->id;
        if ($request->hasFile('file_name'))
        {
            $photo->file_name = $imageSaver->save('file_name', 'galleries', 973, NULL, $photo->file_name);
        }
        // Если выбрано как главное
        if ($request->is_main == 1) {
            // Ищем фотографию с is_main = 1 и этим company_id, но не текущую
            $photoMain = Gallery::whereIsMain(TRUE)
                ->whereCompanyId($photo->company_id)
                ->where('id', '<>', $id)
                ->first();
            if ($photoMain) {
                $photoMain->is_main = FALSE;
                $photoMain->save();
            }
        }
        $photo->is_main = $request->is_main;

        $photo->save();

        return redirect('admin/galleries/edit/'.$photo->id.'?company='.$request->company)
            ->with('success', 'Сертификат успешно сохранен.');
    }

    /**
     * Удаление фотографии.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($id)
    {
        $photo = Gallery::find($id);

        if (empty($photo)) {
            abort(404);
        }

        // Удаляем изображение
        File::delete(public_path('assets' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR .
            'galleries' . DIRECTORY_SEPARATOR . $photo->file_name));

        $photo->delete();

        return redirect()->back()
            ->with('success', 'Фотография успешно удалена.');
    }


}
