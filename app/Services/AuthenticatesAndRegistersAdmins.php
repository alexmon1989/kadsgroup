<?php namespace App\Services;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;
/**
 * Трейт, что переоперделяет некоторые методы базового трейта AuthenticatesAndRegistersUsers
 */
trait AuthenticatesAndRegistersAdmins {

    use AuthenticatesAndRegistersUsers;

    public function getList()
    {
        $data['users'] = User::all();
        return view('admin.auth.list', $data);
    }

    public function getEdit($id)
    {
        $data['user'] = $this->findUser($id);
        return view('admin.auth.edit', $data);
    }

    /**
     * Обработчик запроса на изменение данных юзера
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(Request $request, $id)
    {
        // Ищем юзера
        $user = $this->findUser($id);
        // Валидация
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$id,
            'password' => 'confirmed|min:6',
        ], [
            'name.required' => 'Поле "Логин" обязательно для заполнения.',
            'name.max' => 'Количество символов в поле "Логин" не может превышать :max.',
            'email.email' => 'Поле "E-Mail" должно быть действительным электронным адресом.',
            'email.max' => 'Количество символов в поле "E-Mail" не может превышать :max.',
            'email.unique' => 'Такое значение поля "E-Mail" уже существует.',
            'password.confirmed' => 'Поле "Пароль" не совпадает с подтверждением.',
            'password.min' => '"Количество символов в поле "Пароль" должно быть не менее :min.',
        ]);
        // Изменяем данные и сохраняем
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if ($request->get('password'))
        {
            $user->password = bcrypt($request->get('password'));
        }
        $user->save();
        return redirect()->action('Auth\AuthController@getEdit', array('id' => $user->id))
            ->with('success', 'Пользователь успешно отредактирован.');
    }

    /**
     * Удаление пользователя
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($id)
    {
        // Ищем юзера
        $user = $this->findUser($id);
        if (Auth::user()->id != $id)
        {
            $user->delete();
            return redirect()->back()->with('success', 'Пользователь успешно удалён.');
        }
        return redirect()->back()->withErrors('Вы не можете удалить сами себя.');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('admin.auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $user = $this->create($request->all());
        return redirect()->action('Auth\AuthController@getEdit', array('id' => $user->id))
            ->with('success', 'Пользователь успешно создан.');
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ], [
            $this->loginUsername().'.required' => 'Поле "EMail" обязательно для заполнения.',
            'password.required' => 'Поле "Пароль" обязательно для заполнения.'
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return 'Неверная комбинация логина и пароля.';
    }
    /**
     * Поиск клиента в БД по ид или переадресация на 404
     *
     * @param $id
     * @return \Illuminate\Support\Collection|null|static
     */
    protected function findUser($id)
    {
        // Ищем пользователя
        $user = User::find($id);
        if (empty($user))
        {
            abort(404);
        }
        return $user;
    }
}