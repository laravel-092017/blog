<?php namespace App\Http\Controllers;

use App\Events\FeedbackWasCreated;
use App\Mail\FeedbackMail;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class MainController extends Controller
{
    public function index()
    {
        $posts = Cache::remember('mainPostLists', 10, function () {
             return Post::with(['comments', 'sections'])
                ->active()
                ->intime()
                ->orderBy('id', 'DESC')
                ->get();
        });

        //dump($posts);

        return view('layouts.primary', [
            'page' => 'pages.main',
            'title' => 'Blogplace :: Блог Дмитрий Юрьев - PHP & JS разработчик, ментор, преподаватель',
            'content' => '<p>Привет, меня зовут Дмитрий Юрьев и я веб разработчик!</p>',
            'image' => [
                'path' => 'assets/images/Me.jpg',
                'alt' => 'Image'
            ],
            'activeMenu' => 'main',
            'posts' => $posts,
        ]);
    }

    public function about()
    {
        return view('layouts.primary', [
            'page' => 'pages.about',
            'title' => 'Обо мне',
            'content' => Page::find(1)->content,
            /*'image' => [
                'path' => 'assets/images/Me.jpg',
                'alt' => 'Image'
            ],*/
            'activeMenu' => 'about',
        ]);
    }

    public function feedback()
    {
        return view('layouts.primary', [
            'page' => 'pages.feedback',
            'title' => 'Написать мне',
            'activeMenu' => 'feedback',
        ]);
    }

    public function feedbackPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50|min:2',
            'email' => 'required|max:255|email',
            'message' => 'required|max:10240|min:10',
        ]);

        event(
            new FeedbackWasCreated($request->all())
        );

        /*Mail::to(env('MAIL_TO'))
            ->send(
                new FeedbackMail($request->all())
            );*/

        /*$mailTemplate = View::make('mails.feedback', [
            'data' => $request->all()
        ]);

        Mail::raw($mailTemplate, function($message) {
            $message->from('no-reply@iurev.ru');
            $message->to('yurev@ntschool.ru');
            $message->setContentType('text/html');
            $message->subject('Письмо с блога');
        });*/



        return view('layouts.primary', [
            'page' => 'parts.blank',
            'title' => 'Сообщение отправлено!',
            'content' => 'Спасибо за ваше сообщение!',
            'link' => '<a href="javascript:history.back()">Вернуться назад</a>',
            'activeMenu' => 'feedback',
        ]);
    }
}
