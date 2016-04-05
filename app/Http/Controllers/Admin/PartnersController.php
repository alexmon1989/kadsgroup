<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Partner;
use App\Project;
use App\Services\SavesImages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests\StorePartnerRequest;
use Illuminate\Support\Facades\File;

class PartnersController extends AdminController {

	/**
	 * Отображает список партнёров
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        $partners = Partner::all();

		return view('admin.partners.index', compact('partners'));
	}

    /**
     * Действие для отображения страницы добавления партнёра
     *
     * @return \BladeView|bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate()
    {
        return view('admin.partners.create');
    }

    /**
     * Действие-обрабочик создания партнёра
     *
     * @param StorePartnerRequest $request
     * @param SavesImages $imageSaver
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Services\Exception
     */
    public function postCreate(StorePartnerRequest $request, SavesImages $imageSaver)
    {
        // Создание партнёра
        $partner = new Partner;

        // Присвоение значений полей партнёра
        $partner->title = trim($request->get('title'));
        $partner->description = trim($request->get('description'));
        $partner->web_site = trim($request->get('web_site'));
        $partner->category = trim($request->get('category'));
        $partner->enabled = (int) $request->get('enabled');
        // Изображение
        if ($request->hasFile('image'))
        {
            $partner->image = $imageSaver->save('image', 'partners', 140, 140);
        }

        // Сохранение
        $partner->save();

        // Переадресовывание на страницу редактирования объекта с сообщением об успехе операции
        return redirect()->action('Admin\PartnersController@getEdit', ['id' => $partner->id])
            ->with('success', 'Партнёр успешно создан.');
    }

    /**
     * Действие для отображения страницы редактирования партнёра
     *
     * @param $id
     * @return \BladeView|bool|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEdit($id)
    {
        // Получение данных
        $partner = Partner::find($id);
        if (empty($partner)) {
            abort(404);
        }

        // Отображение страницы
        return view('admin.partners.edit', compact('partner'));
    }

    /**
     * Действие-обработчик запроса на изменение данных объекта
     *
     * @param StorePartnerRequest $request
     * @param SavesImages $imageSaver
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Services\Exception
     */
    public function postEdit(StorePartnerRequest $request, SavesImages $imageSaver, $id)
    {
        // Получение данных
        $partner = Partner::find($id);
        if (empty($partner)) {
            abort(404);
        }

        // Присвоение новых значений полей партнёра
        $partner->title = trim($request->get('title'));
        $partner->description = trim($request->get('description'));
        $partner->web_site = trim($request->get('web_site'));
        $partner->category = trim($request->get('category'));
        $partner->enabled = (int) $request->get('enabled');
        // Изображение
        if ($request->hasFile('image'))
        {
            $partner->image = $imageSaver->save('image', 'partners', 140, 140);
        }

        // Сохранение
        $partner->save();

        // Переадресовывание назад с сообщением об успехе операции
        return redirect()->back()->with('success', 'Партнёр успешно обновлён.');
    }

    /**
     * Действие для удаления партнёра
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($id)
    {
        // Получение данных
        $partner = Partner::find($id);
        if (empty($partner)) {
            abort(404);
        }

        // Удаляем изображение
        $imagePath = public_path('assets' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR .
                                'partners' . DIRECTORY_SEPARATOR . $partner->image);
        if (file_exists($imagePath)) {
            File::delete($imagePath);
        }

        // Удаляем объект из БД
        $partner->delete();

        return redirect()->back()->with('success', 'Партнёр успешно удален.');
    }
}
