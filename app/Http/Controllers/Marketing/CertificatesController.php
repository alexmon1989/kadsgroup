<?php

namespace App\Http\Controllers\Marketing;

use App\Article;
use App\Certificate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CertificatesController extends Controller
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
}
