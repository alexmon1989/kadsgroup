<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrdersRequest;

class OrdersController extends AdminController {

	/**
	 * Отображает список заказов
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        $orders = Order::all();

        return view('admin.orders.index', compact('orders'));
	}

	/**
	 * Отображает страницу редактирования заказа
	 */
	public function getEdit(Order $order)
	{
        return view('admin.orders.edit', compact('order'));
	}

	/**
	 * Обработчик запроса на редактирование заказа
	 */
	public function postEdit(StoreOrdersRequest $request, Order $order)
	{
        $order->username        = $request->username;
        $order->phone           = $request->phone;
        $order->email           = $request->email;
        $order->company         = $request->company;
        $order->comment         = $request->comment;
        $order->product_title   = $request->product_title;
        $order->status          = $request->status;

        $order->save();

        return redirect()->back()->with('success', 'Заказ успешно сохранён.');
	}

	/**
	 * Удаляет заказ
	 */
	public function getDelete(Order $order)
	{
        $order->delete();

        return redirect()->back()->with('success', 'Заказ успешно удалён.');
	}

}
