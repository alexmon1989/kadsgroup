<?php namespace App\Http\Controllers\Admin;

use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Services\SavesImages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\News;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\StoreNewsSettingsRequest;
use Illuminate\Support\Facades\File;

class NewsController extends AdminController {

    // Расположение картинок-превью новостей
    protected $thumbDest;

	/**
	 * Отображает список новостей
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        $data['news'] = News::all();

		return view('admin.news.index', $data);
	}

	/**
	 * Отображает страницу редактирования новсоти
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
        $data['news'] = News::find($id);

        if (empty($data['news'])) {
            abort(404);
        }

        return view('admin.news.edit', $data);
	}

	/**
	 * Обработчик запроса на редактирование новости
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdit(StoreNewsRequest $request, SavesImages $imageSaver, $id)
	{
        $news = News::find($id);

        if (empty($news)) {
            abort(404);
        }

        // Меняем данные и сохраняем
        $news->title                = trim(Input::get('title'));
        $news->full_text            = Input::get('full_text');
        $news->preview_text_small   = Input::get('preview_text_small');
        $news->preview_text_mid     = Input::get('preview_text_mid');
        $news->is_on_main           = Input::get('is_on_main', 0);
        if ($request->hasFile('thumbnail'))
        {
            $news->thumbnail = $imageSaver->save('thumbnail', 'news', 555, 370, $news->thumbnail);
        }
        // Настройки seo
        $news->page_title           = trim($request->get('page_title'));
        $news->page_keywords        = trim($request->get('page_keywords'));
        $news->page_description     = trim($request->get('page_description'));
        $news->page_h1              = trim($request->get('page_h1'));
        $news->save();

        return redirect()->action('Admin\NewsController@getEdit', array('id' => $id))
                         ->with('success', 'Новость успешно сохранена.');
	}

	/**
	 * Отображает страницу создания новости
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        return view('admin.news.add');
	}

	/**
	 * Обработчик запроса на создание новости
	 *
	 * @return Response
	 */
	public function postCreate(StoreNewsRequest $request, SavesImages $imageSaver)
	{
		$news = new News;
        $news->title                = trim(Input::get('title'));
        $news->full_text            = Input::get('full_text');
        $news->preview_text_small   = Input::get('preview_text_small');
        $news->preview_text_mid     = Input::get('preview_text_mid');
        $news->is_on_main           = Input::get('is_on_main', 0);
        $news->thumbnail            = $imageSaver->save('thumbnail', 'news', 555, 370);
        // Настройки seo
        $news->page_title           = trim($request->get('page_title'));
        $news->page_keywords        = trim($request->get('page_keywords'));
        $news->page_description     = trim($request->get('page_description'));
        $news->page_h1              = trim($request->get('page_h1'));
        $news->save();

        return redirect()->action('Admin\NewsController@getEdit', array('id' => $news->id))
                        ->with('success', 'Новость успешно сохранена.');
	}

	/**
	 * Удаляет новость
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDelete($id)
	{
        $news = News::find($id);

        if (empty($news)) {
            abort(404);
        }

        // Удаляем изображение
        File::delete(public_path('assets' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR .
                                 'news' . DIRECTORY_SEPARATOR . $news->thumbnail));

        $news->delete();

        return redirect()->action('Admin\NewsController@getIndex')
                        ->with('success', 'Новость успешно удалена.');
	}

    /**
     * Действие для отображения страницы настроек модуля.
     *
     * @return \Illuminate\View\View
     */
    public function getSettings()
    {
        // Статья с описанием новостей
        Model::unguard();
        $data['news_description'] = Article::firstOrCreate(['type' => 'news_description']);
        Model::reguard();

        return view('admin.news.settings', $data);
    }

    /**
     * Действие-обработчик сохранение настроек модуля
     *
     * @param StoreNewsSettingsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSettings(StoreNewsSettingsRequest $request)
    {
        // Изменяем статью
        $article = Article::whereType('news_description')->first();
        $article->title             = $request->get('title');
        $article->full_text         = $request->get('full_text');
        $article->page_title        = $request->get('page_title');
        $article->page_keywords     = $request->get('page_keywords');
        $article->page_description  = $request->get('page_description');
        $article->page_h1           = $request->get('page_h1');
        $article->save();

        return redirect()->back()->with('success', 'Данные успешно сохранены.');
    }
}
