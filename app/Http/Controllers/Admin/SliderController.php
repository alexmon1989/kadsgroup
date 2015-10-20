<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Slider;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSlidersRequest;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class SliderController extends AdminController {

    /**
     * Отображает список слайдов.
     *
     * @return Response
     */
    public function getIndex()
    {
        // Получаем список слайдов
        $data['sliders'] = Slider::all();
        return view('admin.slider.index', $data);
    }

    /**
     * Страница редактирования слайда
     *
     * @param $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        $slider = $this->findSlider($id);
        return view('admin.slider.edit', array('slider' => $slider));
    }

    /**
     * Запрос на редактирование данных слайда
     *
     * @param StoreSlidersRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(StoreSlidersRequest $request, $id)
    {
        // Ищем слайд
        $slider = $this->findSlider($id);
        $slider->title = trim($request->get('title'));
        $slider->description_1 = trim($request->get('description_1'));
        $slider->description_2 = trim($request->get('description_2'));
        if ($request->hasFile('file_name'))
        {
            $slider->file_name = $this->saveImageToDisk($slider->file_name);
        }
        $slider->url = trim($request->get('url'));
        $slider->btn_text = trim($request->get('btn_text'));
        $slider->enabled = $request->get('enabled', 0);
        $slider->save();
        return redirect()->action('Admin\SliderController@getEdit', array('id' => $slider->id))
            ->with('success', 'Слайд успешно изменён.');
    }

    /**
     * Страница создания слайда
     *
     * @return \Illuminate\View\View
     */
    public function getCreate()
    {
        return view('admin.slider.create');
    }

    /**
     * Запрос на создание слайда
     *
     * @param StoreSlidersRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(StoreSlidersRequest $request)
    {
        // Создаём новый слайдер
        $slider = new Slider;
        $slider->title = trim($request->get('title'));
        $slider->description_1 = trim($request->get('description_1'));
        $slider->description_2 = trim($request->get('description_2'));
        $slider->file_name = $this->saveImageToDisk();
        $slider->url = trim($request->get('url'));
        $slider->btn_text = trim($request->get('btn_text'));
        $slider->enabled = $request->get('enabled', 0);
        // Присваем макс. порядок + 1
        $slider->order = Slider::max('order') + 1;
        $slider->save();
        return redirect()->action('Admin\SliderController@getEdit', array('id' => $slider->id))
            ->with('success', 'Слайд успешно создан.');
    }

    /**
     * Действие для удаления слайда.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($id)
    {
        // Ищем слайд
        $slider = $this->findSlider($id);
        // Всем слайдам после этого уменьшаем позицию
        $slidesDecrOrder = Slider::where('order', '>', $slider->order)->get();
        foreach($slidesDecrOrder as $item)
        {
            $item->order -= 1;
            $item->save();
        }
        // Удаляем вместе с файлами
        File::delete( 'assets/img/slider' . $slider->file_main );
        File::delete( 'assets/img/slider/logo' . $slider->file_logo );
        $slider->delete();
        return redirect()->back()->with('success', 'Слайд успешно удалён.');
    }

    /**
     * Увеличение позиции слайда
     *
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function getIncreasePosition($id)
    {
        // Ищем слайд
        $slider = $this->findSlider($id);
        // Слайду после - ставим позицию текущего слайда, а сначала ищем его
        $orderNext = $slider->order + 1;
        $sliderNext = Slider::where('order', '=', $orderNext)->first();
        // Если он существует, то делаем изменения, если нет - это последний слайд, изменения невозможны
        if ($sliderNext)
        {
            $sliderNext->order = $slider->order;
            $sliderNext->save();
            $slider->order = $orderNext;
            $slider->save();
            return redirect()->back()->with('success', 'Порядок успешно изменён.');
        }
        return redirect()->back()->withErrors('Порядок не может быть изменён, это и так последний слайд.');
    }

    /**
     * Уменьшение позиции слайда
     *
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function getDecreasePosition($id)
    {
        // Ищем слайд
        $slider = $this->findSlider($id);
        // Слайду до - ставим позицию текущего слайда, а сначала ищем его
        $orderPrev = $slider->order - 1;
        $sliderPrev = Slider::where('order', '=', $orderPrev)->first();
        // Если он существует, то делаем изменения, если нет - это первый слайд, изменения невозможны
        if ($sliderPrev)
        {
            $sliderPrev->order = $slider->order;
            $sliderPrev->save();
            $slider->order = $orderPrev;
            $slider->save();
            return redirect()->back()->with('success', 'Порядок успешно изменён.');
        }
        return redirect()->back()->withErrors('Порядок не может быть изменён, это и так первый слайд.');
    }

    /**
     * Метод для добавления изображения в соотв. папку
     *
     * @param $old_name Название старого фалйа (если указан, то он удаляется)
     * @return string Название загруженного файла с его расширением
     */
    private function saveImageToDisk($old_name = NULL)
    {
        // Название изображения
        $name = str_random(10);
        // Загруженный файл
        $upload_file = Input::file('file_name');
        Image::make($upload_file)
            ->resize(1920, 350)
            ->save($this->thumbDest.$name.'.'.$upload_file->getClientOriginalExtension());
        // Если есть старый файл, то удаляем его
        if ($old_name)
        {
            File::delete( $this->thumbDest.$old_name );
        }
        return $name.'.'.$upload_file->getClientOriginalExtension();
    }

    /**
     * Поиск слайдера в БД по ид или переадресация на 404
     *
     * @param $id
     * @return \Illuminate\Support\Collection|null|static
     */
    private function findSlider($id)
    {
        // Ищем слайд
        $slider = Slider::find($id);
        if (empty($slider))
        {
            abort(404);
        }
        return $slider;
    }
}