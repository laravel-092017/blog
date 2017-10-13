<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class MainController extends Controller
{
    public function mainPage()
    {
        return view('pages.main', [
            'title' => 'Main page'
        ]);
    }

    public function aboutPage()
    {
        return view('pages.about', [
            'title' => 'About company'
        ]);
    }

    public function notFoundPage()
    {
        return view('404');
    }
/*
    public function user($id = null)
    {
        if (User::hasRights('post.create')) {
            if (is_null($id)) {
                abort(404);
            }

            return "Requested User with ID " . $id;
        } else {
            abort(403);
        }


    }*/

    public function response1()
    {
        $counter = resolve('AwesomeCounter');
        $counter->increment();
        $counter->increment();

        return $counter->getValue();
        //return 'OK1';
    }

    public function response2()
    {
        $content = <<<HTML
http://site.ru/54534568687545345686875453456868754534568687

Route::get(/{id})->where('id', '\d{40}')
<br>
<br>
<h1>10000000001</h1>
54534568687
99999999999

http://site.ru/news/
HTML;



        return response($content, 200)
            ->header('Content-Type', 'text/plain')
            ->header('X-Custom-Header', 'Header Value')
            ->cookie('mycookie', 'val', 60*24);
    }

    public function response3()
    {
        return redirect('http://ya.ru/');
    }

    public function response4()
    {
        return redirect()
            ->route('notFoundPage');
    }

    public function response5()
    {
        return redirect()
            ->action('MainController@response2');
    }

    public function response6()
    {
       /*$string = (string) json_encode([
           'a' => 1,
           'b' => '2',
           'c' => true
       ]);

        return response($string)
            ->header('Content-Type', 'application/json');
        */

        return [
            'a' => 1,
            'b' => '2',
            'c' => true
        ];
    }

    public function response7()
    {
        return response()
            ->download(public_path('desc.txt'));
    }

    public function response8()
    {
        return view('test', [
            'userCount' => '1',
            /*'userName' => 'Dima',*/
        ]);
    }
}