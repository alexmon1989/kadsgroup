<?php

namespace App\Http\Controllers\Marketing;

use App\Partner;
use App\Project;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PartnersProjectsController extends Controller
{
    /**
     * Действие для отображения индексной страницы
     */
    public function index()
    {
        $partners = Partner::whereEnabled(true)
            ->orderBy('created_at', 'DESC')
            ->get();

        $projects = Project::whereEnabled(true)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('marketing.partners-projects.index', compact('partners', 'projects'));
    }

    /**
     * Действие для отображения страницы строит. объекта
     *
     * @param $slug
     * @return \BladeView|bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function project($slug)
    {
        $project = Project::whereEnabled(true)
            ->whereSlug($slug)
            ->first();

        if ($project) {
            return view('marketing.partners-projects.project', compact('project'));
        }

        abort(404);
    }
}
