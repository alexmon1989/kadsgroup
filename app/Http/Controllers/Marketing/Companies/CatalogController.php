<?php

namespace App\Http\Controllers\Marketing\Companies;

use App\Company;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

abstract class CatalogController extends Controller
{
    // Краткий код фирмы
    protected $shortTitle;

    public function __construct()
    {
        View::share('company', Company::whereShortTitle($this->shortTitle)->first());
    }

    abstract public function getIndex($categoryId = NULL);
}
