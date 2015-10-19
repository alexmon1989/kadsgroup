<?php

namespace App\Http\Controllers\Marketing;

use App\Article;
use App\Certificate;
use App\Gallery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GalleriesController extends Controller
{
    /**
     * Отображает индексную страницу модуля.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        // Статья
        Model::unguard();
        $data['certificates_description'] = Article::firstOrCreate(['type' => 'certificates_description']);
        Model::reguard();

        // Сертификаты
        $data['certificates'] = Certificate::orderBy('created_at', 'DESC')->paginate(6);

        return view('marketing.certificates.index', $data);
    }


    /**
     * Дейстиве для отображения страницы галереи компании.
     *
     * @param $company
     * @return \Illuminate\View\View
     */
    public function getShow($company)
    {
        // Статья
        Model::unguard();
        $data['article'] = Article::firstOrCreate(['type' => 'gallery_'.$company.'_description']);
        Model::reguard();

        // Фотографии
        $data['photos'] = Gallery::orderBy('created_at', 'DESC')->paginate(9);

        return view('marketing.galleries.show', $data);
    }
}
