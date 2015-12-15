<?php

namespace App\Http\Controllers\Admin;

use App\Article;
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
    public function getIndex()
    {
        // Видео
        $data['videos'] = Video::orderBy('created_at', 'DESC')->get();

        return view('admin.videos.index', $data);
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
        $data['videos_description'] = Article::firstOrCreate(['type' => 'videos_description']);
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
        $article = Article::whereType('videos_description')->first();
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
    public function getCreate()
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
        $video->save();

        return redirect()->action('Admin\VideosController@getEdit', array('id' => $video->id))
            ->with('success', 'Видео успешно сохранено.');
    }

    /**
     * Действие для отображения страницы редактирования видео.
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
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
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Services\Exception
     */
    public function postEdit(StoreVideosRequest $request, $id)
    {
        $video = Video::find($id);

        if (empty($video)) {
            abort(404);
        }

        // Меняем данные и сохраняем
        $video->youtube_id = trim($request->youtube_id);
        $video->save();

        return redirect()->action('Admin\VideosController@getEdit', array('id' => $id))
            ->with('success', 'Видео успешно сохранено.');
    }

    /**
     * Удаление видео.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($id)
    {
        $video = Video::find($id);

        if (empty($video)) {
            abort(404);
        }

        $video->delete();

        return redirect()->action('Admin\VideosController@getIndex')
            ->with('success', 'Видео успешно удалено.');
    }


}
