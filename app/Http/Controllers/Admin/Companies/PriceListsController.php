<?php

namespace App\Http\Controllers\Admin\Companies;

use App\Company;
use App\Http\Controllers\Admin\AdminController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\StorePriceListsRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Orchestra\Support\Facades\Memory;

class PriceListsController extends AdminController
{
    private $companyName;

    public function __construct(Request $request)
    {
        parent::__construct();

        // С какой фирмой работаем
        $this->companyName = $request->get('company');
        if (!in_array($this->companyName, ['primer'])) { // на момент разработки прайс-лист есть только для Праймера
            abort(404);
        }
    }

    /**
     * Отображает индексную страницу модуля
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        // Ищем кфирму по короткому названию
        $data['company'] = Company::whereShortTitle($this->companyName)->first();

        if (empty($data['company'])) {
            abort(404);
        }

        // Последнее обновление прайса
        $last_update = Memory::get('price.primer.last_update');
        $data['last_update'] = 'Никогда';
        if ($last_update) {
            $data['file_name'] = Memory::get('price.primer.file_name');
            $data['last_update'] = date('d.m.Y в H:i:s', strtotime($last_update));
        }

        return view('admin.companies.price_list.index', $data);
    }

    /**
     * Обработчик запроса на сохранение нового прайса.
     *
     * @param StorePriceListsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Services\Exception
     */
    public function postIndex(StorePriceListsRequest $request)
    {
        // Удаляем старый файл
        File::delete('assets/price-list/'.Memory::get('price.primer.file_name'));

        // Сохраняем загруженный файл
        $fileName = 'prices.'.$request->file('file_name')->getClientOriginalExtension();
        $request->file('file_name')->move('assets/price-list/', $fileName);

        // Обновляем данные БД
        Memory::put('price.primer.file_name', $fileName);
        Memory::put('price.primer.last_update', Carbon::now());

        return redirect()->back()->with('success', 'Прайс-лист успешно обновлён.');
    }
}
