<?php namespace App\Http\Controllers;

use App\Events\FeedbackWasCreated;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function simple(Request $request)
    {
        $name = $request->input('name');
        $surname = $request->input('surname');
        $age = $request->input('age');

        //abort(500);

        return view('api.simple', [
            'name' => $name,
            'surname' => $surname,
            'age' => $age,
        ]);
    }

    public function feedback(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50|min:2',
            'email' => 'required|max:255|email',
            'message' => 'required|max:10240|min:10',
        ]);

        event(
            new FeedbackWasCreated($request->all())
        );

        return 'OK';
    }
}
