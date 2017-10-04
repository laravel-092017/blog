<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function mainPage()
    {
        return view('welcome');
    }

    public function notFoundPage()
    {
        return view('404');
    }

    public function user($id = null)
    {
        if (is_null($id)) {
            abort(404);
        }

        return "Requested User with ID " . $id;
    }
}
