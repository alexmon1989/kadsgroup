<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Company;
use App\Video;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\StoreVideosSettingsRequest;
use App\Http\Requests\StoreVideosRequest;
use App\Http\Controllers\Controller;

class VideosController extends AdminController
{
    /**
     * Отображает индексную страницу модуля.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request)
    {
        // Видео
        $data['videos'] = Company::whereShortTitle($request->segment(3))
            ->first()
            ->videos;

        return view('admin.videos.index', $data);
    }

    /**
     * Действие для отображения страницы настроек модуля.
     *
     * @return \Illuminate\View\View
     */
    public function getSettings(Request $request)
    {
        // Статья с описанием сертификатов
        Model::unguard();
        $data['videos_description'] = Article::firstOrCreate(['type' => $request->segment(3) . '_videos_description']);
        Model::reguard();

        return view('admin.videos.settings', $data);
    }

    /**
     * Действие-обработчик сохранение настроек модуля
     *
     * @param StoreVideosSettingsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSettings(StoreVideosSettingsRequest $request)
    {
        // Изменяем статью
        $article = Article::whereType($request->segment(3) . '_videos_description')->first();
        $article->title = $request->get('title');
        $article->full_text = $request->get('full_text');
        $article->page_title        = $request->get('page_title');
        $article->page_keywords     = $request->get('page_keywords');
        $article->page_description  = $request->get('page_description');
        $article->page_h1           = $request->get('page_h1');
        $article->save();

        return redirect()->back()->with('success', 'Данные успешно сохранены.');
    }

    /**
     * Действие для отображения страницы создания видео.
     *
     * @return \Illuminate\View\View
     */
    public function getCreate(Request $request)
    {
        return view('admin.videos.add');
    }

    /**
     * Действие-обработчик запроса на сохранение видео.
     *
     * @param StoreVideosRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Services\Exception
     */
    public function postCreate(StoreVideosRequest $request)
    {
        $video = new Video;
        $video->youtube_id = trim($request->youtube_id);
        $video->company_id = Company::whereShortTitle($request->segment(3))->first()->id;
        $video->save();

        return redirect()->action('Admin\VideosController@getEdit', ['company' => $request->segment(3), 'id' => $video->id])
            ->with('success', 'Видео успешно сохранено.');
    }

    /**
     * Действие для отображения страницы редактирования видео.
     *
     * @return \Illuminate\View\View
     */
    public function getEdit(Request $request)
    {
        $id = $request->segment(6);
        $data['video'] = Video::find($id);

        if (empty($data['video'])) {
            abort(404);
        }

        return view('admin.videos.edit', $data);
    }

    /**
     * Действие-обработчик запроса на редактирование видео
     *
     * @param StoreVideosRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(StoreVideosRequest $request)
    {
        $id = $request->segment(6);
        $video = Video::find($id);

        if (empty($video)) {
            abort(404);
        }

        // Меняем данные и сохраняем
        $video->youtube_id = trim($request->youtube_id);
        $video->company_id = Company::whereShortTitle($request->segment(3))->first()->id;
        $video->save();

        return redirect()->action('Admin\VideosController@getEdit', ['company' => $request->segment(3), 'id' => $id])
            ->with('success', 'Видео успешно сохранено.');
    }

    /**
     * Удаление видео.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete(Request $request)
    {
        $id = $request->segment(6);
        $video = Video::find($id);

        if (empty($video)) {
            abort(404);
        }

        $video->delete();

        return redirect()->action('Admin\VideosController@getIndex', ['company' => $request->segment(3)])
            ->with('success', 'Видео успешно удалено.');
    }


}
