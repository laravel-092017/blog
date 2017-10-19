<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        $posts = [];

        return view('layouts.primary', [
            'page' => 'pages.main',
            'title' => 'Blogplace :: Блог Дмитрий Юрьев - PHP & JS разработчик, ментор, преподаватель',
            'content' => '<p>Привет, меня зовут Дмитрий Юрьев и я веб разработчик!</p>',
            'image' => [
                'path' => 'assets/images/Me.jpg',
                'alt' => 'Image'
            ],
            'activeMenu' => 'main',
            'posts' => $posts
        ]);
    }

    public function about()
    {
        return view('layouts.primary', [
            'page' => 'pages.about',
            'title' => 'Обо мне',
            'content' => '<p>Привет, меня зовут Дмитрий Юрьев и я веб разработчик!</p>',
            'image' => [
                'path' => 'assets/images/Me.jpg',
                'alt' => 'Image'
            ],
            'activeMenu' => 'about',
        ]);
    }

    public function feedback()
    {
        return view('layouts.primary', [
            'page' => 'pages.feedback',
            'title' => 'Написать мне',
            'content' => '<p>Привет, меня зовут Дмитрий Юрьев и я веб разработчик!</p>',
            'activeMenu' => 'feedback',
        ]);
    }

    public function db(Request $request)
    {

        $sortBy = $request->input('sortBy', 'DESC');
        $sql = "SELECT * FROM users";

        /*$data = DB::table('users')
            ->where('name', 'LIKE', '%ася')
            ->orWhere('email','petya@mail.ru')
            ->get(['name','email']);
*/

        /*$user = DB::table('users')
            ->where('name', 'Вася')
            ->first();

        //dump($data);
        echo $user->name;*/

        $sql="select * from `users` where `name` LIKE '%ася' or `email` = 'petya@mail.ru' order by `id` desc limit 1 offset 0";

        $data = DB::table('users')
            ->where('name', 'LIKE', '%ася')
            ->orWhere('email','petya@mail.ru')
            ->limit(1)
            ->offset(0);

        if ($sortBy == 'DESC') {
            $data->orderBy('id', 'DESC');
        } else {
            $data->orderBy('id', 'ASC');
        }

        $data->get();


/*
foreach ($data as $row) {
    echo $row->name . $row->email,'<br>';
}*/

        dump($data);


        $content = '123';

        return view('layouts.primary', [
            'page' => 'pages.blank',
            'title' => 'Написать мне',
            'content' => $content,
            'activeMenu' => 'feedback',
        ]);
    }
}
