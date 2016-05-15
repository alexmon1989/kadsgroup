<?php

namespace App\Http\Controllers\Marketing\Companies;

use App\Events\OrderWasCreatedEvent;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    /**
     * Обработчик запроса на заказ
     */
    public function makeOrder(Request $request)
    {
        $this->validate($request, [
            'username'      => 'required|max:255',
            'company'       => 'max:255',
            'email'         => 'required|email|max:255',
            'phone'         => 'required|max:255',
            'product_title' => 'required',
        ]);

        // Сохранение в БД
        $order = Order::create([
            'username'      => $request->username,
            'company'       => $request->company,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'comment'       => $request->comment,
            'product_title' => $request->product_title,
            'status'        => 1, // Новый заказ
        ]);

        // Отправка на почту с помощью событий
        event(new OrderWasCreatedEvent($order));

        return ['status' => 'ok'];
    }
}
