<?php namespace App\Http\Controllers\Admin;

use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Services\SavesImages;
use Illuminate\Http\Request;

use App\News;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

class HomeController extends AdminController {
	/**
	 * Отображает список новостей
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        $data['article'] = Article::whereType('main_article')
            ->first(['full_text', 'page_title', 'page_keywords', 'page_description']);

		return view('admin.home.index', $data);
	}

	/**
	 * Обработчик запроса на редактирование.
	 *
	 * @return Response
	 */
	public function postIndex(Requests\StoreArticleRequest $request)
	{
        $article = Article::whereType('main_article')->first();

        if (empty($article)) {
            abort(404);
        }

        // меняем данные и сохраняем
        $article->full_text = trim(Input::get('full_text'));
        $article->page_title = trim(Input::get('page_title'));
        $article->page_keywords = trim(Input::get('page_keywords'));
        $article->page_description = trim(Input::get('page_description'));

        $article->save();

        return redirect()->back()->with('success', 'Информация для главной страницы успешно сохранена.');
	}
}
