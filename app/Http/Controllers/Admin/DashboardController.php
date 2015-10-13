<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends AdminController {
    /**
     * Действие для отображения Dashboard
     *
     * @return Response
     */
    public function getIndex()
    {
        return view('admin.dashboard.index');
    }
}