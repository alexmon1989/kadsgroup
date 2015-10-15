<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Admin\AdminController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Services\AuthenticatesAndRegistersAdmins;

class AuthController extends AdminController
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersAdmins, ThrottlesLogins;

    // Пути
    protected $redirectPath = 'admin/dashboard';
    protected $loginPath = 'admin/auth/login';
    protected $redirectAfterLogout = 'admin/auth/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth', ['except' => ['getLogout', 'getLogin', 'postLogin']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ], [
            'name.required' => 'Поле "Логин" обязательно для заполнения.',
            'name.max' => 'Количество символов в поле "Логин" не может превышать :max.',
            'email.required' => 'Поле "E-Mail" обязательно для заполнения.',
            'email.email' => 'Поле "E-Mail" должно быть действительным электронным адресом.',
            'email.max' => 'Количество символов в поле "E-Mail" не может превышать :max.',
            'email.unique' => 'Такое значение поля "E-Mail" уже существует.',
            'password.required' => 'Поле "Пароль" обязательно для заполнения.',
            'password.confirmed' => 'Поле "Пароль" не совпадает с подтверждением.',
            'password.min' => '"Количество символов в поле "Пароль" должно быть не менее :min.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getList()
    {
        $data['users'] = User::all();
        return view('admin.auth.list', $data);
    }

}
