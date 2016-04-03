<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ProjectsController extends AdminController {

	/**
	 * Отображает список строит. объектов
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        $projects = Project::all();

		return view('admin.projects.index', compact('projects'));
	}

    public function getCreate()
    {

    }

    public function getEdit($id)
    {

    }

    public function getDelete($id)
    {

    }
}
