<?php namespace App\Http\Controllers;

//use App\Includes\Classes\MyCounter;
use App\Includes\CounterInterface;
use Illuminate\Http\Request;

class TestController extends Controller
{
    protected $counter;

    public function __construct(CounterInterface $counter)
    {
        $this->counter = $counter;
        //$this->counter = resolve('AwesomeCounter');
        //$this->counter = new MyCounter();
    }

    public function testGetMethod(Request $request)
    {
        $name = $request->input('name', 'Вася');
        $age = $request->input('age', '10');
        $token = csrf_token();

        $html = <<<HTML
<h1>Привет, $name!</h1>
<h1>Мне $age лет!</h1>
<form method="POST" action="">
    <input type="hidden" name="_token" value="$token">
    Login: <input type="text" name="login"><br>
    Password: <input type="text" name="password">
    <input type="submit" value="Go!">
</form>
HTML;
        return $html;
    }

    public function testPostMethod(Request $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');

        dump($login, $password);

        return 'OK';
    }

    public function testGetPostMethod(Request $request)
    {
        return 'OK';
    }

    public function redirectPage()
    {
        $url = route('notFoundPage');
        echo $url;

        //return redirect()->route('notFoundPage');
    }

    public function some()
    {
        //return myFormatDate(time());
        //$counter->some();
        //$counter = resolve('AwesomeCounter');
        //$counter->
        //$counter = new MyCounter();

        $this->counter->increment();
        $this->counter->increment();
        $this->counter->increment();
        $this->counter->decrement();

        return $this->counter->getValue();
    }
}
