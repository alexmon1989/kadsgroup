<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Project;
use App\Services\SavesImages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use Illuminate\Support\Facades\File;

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

    /**
     * Действие для отображения страницы добавления строит. объекта
     *
     * @return \BladeView|bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate()
    {
        return view('admin.projects.create');
    }

    /**
     * Действие-обрабочик создания строит. объекта
     *
     * @param StoreProjectRequest $request
     * @param SavesImages $imageSaver
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Services\Exception
     */
    public function postCreate(StoreProjectRequest $request, SavesImages $imageSaver)
    {
        // Создание проекта
        $project = new Project;

        // Присвоение значений полей объекту
        $project->title = trim($request->get('title'));
        if (trim($request->get('slug')) != '') {
            $project->slug = trim($request->get('slug'));
        } else {
            $project->slug = str_slug($project->title);
        }
        $project->description_short = trim($request->get('description_short'));
        $project->description_full = trim($request->get('description_full'));
        $project->enabled = (int) $request->get('enabled');
        // Изображение
        if ($request->hasFile('image'))
        {
            $project->image = $imageSaver->save('image', 'projects', 140, 140);
        }

        // Сохранение
        $project->save();

        // Переадресовывание на страницу редактирования объекта с сообщением об успехе операции
        return redirect()->action('Admin\ProjectsController@getEdit', ['id' => $project->id])
            ->with('success', 'Объект успешно создан.');
    }

    /**
     * Действие для отображения страницы редактирования строит. объекта
     *
     * @param $id
     * @return \BladeView|bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEdit($id)
    {
        // Получение данных
        $project = Project::find($id);
        if (empty($project)) {
            abort(404);
        }

        // Отображение страницы
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Действие-обработчик запроса на изменение данных объекта
     *
     * @param StoreProjectRequest $request
     * @param SavesImages $imageSaver
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Services\Exception
     */
    public function postEdit(StoreProjectRequest $request, SavesImages $imageSaver, $id)
    {
        // Получение данных
        $project = Project::find($id);
        if (empty($project)) {
            abort(404);
        }

        // Присвоение новых значений полей объекту
        $project->title = trim($request->get('title'));
        if (trim($request->get('slug')) != '') {
            $project->slug = trim($request->get('slug'));
        } else {
            $project->slug = str_slug($project->title);
        }
        $project->description_short = trim($request->get('description_short'));
        $project->description_full = trim($request->get('description_full'));
        $project->enabled = (int) $request->get('enabled');
        // Новое изображение
        if ($request->hasFile('image'))
        {
            $project->image = $imageSaver->save('image', 'projects', 140, 140, $project->image);
        }

        // Сохранение
        $project->save();

        // Переадресовывание назад с сообщением об успехе операции
        return redirect()->back()->with('success', 'Объект успешно обновлён.');
    }

    /**
     * Действие для удаления строит. объекта
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($id)
    {
        // Получение данных
        $project = Project::find($id);
        if (empty($project)) {
            abort(404);
        }

        // Удаляем изображение
        $imagePath = public_path('assets' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR .
                                'projects' . DIRECTORY_SEPARATOR . $project->image);
        if (file_exists($imagePath)) {
            File::delete($imagePath);
        }

        // Удаляем объект из БД
        $project->delete();

        return redirect()->back()->with('success', 'Объект успешно удален.');
    }
}
