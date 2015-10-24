<?php

namespace App\Http\Controllers\Marketing;

use App\Article;
use App\Company;
use App\Gallery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GalleriesController extends Controller
{
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
        $data['photos'] = Gallery::whereHas('company', function ($query) use ($company) {
            $query->where('short_title', '=', $company);
        })->orderBy('created_at', 'DESC')->paginate(9);

        // Компания
        $data['company'] = Company::whereShortTitle($company)->first(['title']);

        // Отображаем
        return view('marketing.galleries.show', $data);
    }
}
