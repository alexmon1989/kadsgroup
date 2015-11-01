<?php

namespace App\Http\Controllers\Marketing\Companies;

use App\Company;
use App\GroupsCategory;
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

    /**
     * Выборка групп категорий для фирмы вместе с подкатегориями (для бокового меню)
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    protected function getCategories()
    {
        $categories = GroupsCategory::whereEnabled(TRUE)
            ->orderBy('order', 'ASC')
            ->with(['categories' => function ($q) {
                $q->whereNull('parent_id')
                    ->where('enabled', '=', TRUE)
                    ->orderBy('order', 'asc')
                    ->with('child_categories');
            }])
            ->whereHas('company', function($query) {
                $query->where('short_title', '=', $this->shortTitle);
            })
            ->get();

        return $categories;
    }
}
