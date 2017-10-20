<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register()
    {
        return view('layouts.secondary', [
            'page' => 'pages.register',
            'title' => 'Регистрация в блоге',
            'content' => '',
            'activeMenu' => 'register',
        ]);
    }

    /**
     * "_token" => "10VkFWYEQUrlfFYfg1KlWdU6szmrkwdtXs5Uvghb"
    "name" => "dsfsdf"
    "email" => "sdfsdf"
    "password" => "sdfsdfsd"
    "password2" => "fsdfsdf"
    "phone" => "sdfsdfsd"
    "is_confirmed" => "on"
     */
    public function registerPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|max:255|min:6',
            'password2' => 'required|same:password',
            /*'phone' => '/regex:/\+\d{1}\s{1}\(\d{3}\)\s{1}\d{3}\-\d{2}\-\d{2}/',*/
            'is_confirmed' => 'accepted'
        ]);

        /*$validator = Validator::make($request->all(), [
            'name' => 'required|max:255|min:3',
            'email' => 'active_url',
            'password' => 'required|max:255|min:6|numeric',
            'password2' => 'required|same:password',
            'phone' => 'regex:/\+\d{1}\s{1}\(\d{3}\)\s{1}\d{3}\-\d{2}\-\d{2}/',
            'is_confirmed' => 'accepted'
        ]);*/

        //dump($validator);

        /*if ($validator->fails()) {
            return redirect('/')
                ->withErrors($validator)
                ->withInput();
        }*/


        DB::table('users')->insert([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'phone' => $request->input('phone'),
            'created_at' => Carbon::createFromTimestamp(time())
                ->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::createFromTimestamp(time())
                ->format('Y-m-d H:i:s'),
        ]);

        return redirect()
            ->route('site.main.index')
            ->with('register', true);
    }

    public function login()
    {
        return view('layouts.secondary', [
            'page' => 'pages.login',
            'title' => 'Вход в систему',
            'content' => '<p>Привет, меня зовут Дмитрий Юрьев и я веб разработчик!</p>',
            'activeMenu' => 'feedback',
        ]);
    }

    public function loginPost(Request $request)
    {
        $remember = $request->input('remember') ? true : false;

        $authResult = Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ], $remember);

        if ($authResult) {
            return redirect()
                ->route('site.main.index');
        } else {
            return redirect()
                ->route('site.auth.login')
                ->with('authError', 'Неправильный логин или пароль!');
        }
    }
}
