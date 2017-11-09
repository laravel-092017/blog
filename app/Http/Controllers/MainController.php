<?php namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Tag;
use App\Models\User;
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

    public function orm()
    {
        /*$customer = new Customer();

        $customer->name = 'Сидор';
        $customer->surname = 'Сидоров';
        $customer->patronymic = 'Сидорович';
        $customer->age = 40;
        $customer->birthdate = '1984-06-23';
        $customer->notes = 'sdfsdfsdf';

        $customer->save();*/

        /*$customer = Customer::find(3);

        $customer->age = 18;
        $customer->birthdate = '2008-04-12';

        $customer->save();*/

        /*$customers1 = DB::table('customers')->where('name', '=', 'Иван')->get();
        $customers2 = Customer::where('name', '=', 'Иван')->get();

        foreach ($customers1 as $customer1) {
            echo $customer1->name, ' - ', $customer1->age, '<br>';
        }

        foreach ($customers2 as $customer2) {
            echo $customer2->name, ' - ', $customer2->age, '<br>';
            $customer2->name = 'Dmitrii';
            $customer2->surname = 'Iurev';
            $customer2->save();
        }

        dump($customers1, $customers2);*/

        //$customer = Customer::where('name', 'Dmitrii')->first();
        //dump($customer);
        //$customer->delete();




        $newModel = Customer::create([
            'name' => 'Alfred',
            'surname' => 'Ivanov',
            'age' => 22,
            'birthdate' => '1990-01-30',
            'notes' => 'NTSchool student'
        ]);

        $customers = Customer::all();

        dump($customers, $newModel);



        //return 'ORM';
    }

    public function relations()
    {
        //$user = User::find(1);
        //$userProfile = $user->profile;
        //$userBirthday = User::find(1)->profile->birthdate;


        //dump($user->email, $userProfile->name, $userProfile->birthdate);

        //$profile = $user;

        //dump($profile);

        /*$userModel = Profile::where('name', 'Dmitrii')
            ->first()
            ->user
            ->id;

        dump($userModel);*/


        /*$postsByUser1 = User::find(1)
            ->posts;*/

        /*$postsByUser2 = Post::where('user_id', 1)
            ->get();

        $postsByUser3 = DB::table('posts')
            ->where('user_id', 1)
            ->get();*/

        //dump($postsByUser1);//, $postsByUser2, $postsByUser3);

        /*return view('layouts.primary', [
            'page' => 'pages.main',
            'posts' => User::find(1)->posts
        ]);*/

        /*echo Post::find(1)
            ->user
            ->profile
            ->name;*/


        /*$tags = Post::where('slug', '222')->first()->tags;

        dump($tags);
        $tagsString = '';

        foreach ($tags as $tag) {
            $tagsString .= $tag->name . ', ';
        }

        echo rtrim(trim($tagsString), ',');

        $postsByTag = Tag::where('name', 'Просто тэг')->first()->posts;

        foreach ($postsByTag as $post) {
            echo $post->id, '<br>';
        }

        $posts1 = Post::has('tags')->get();

        $posts2 = Post::has('tags', '>=', 2)->get();

        dump($posts1, $posts2);

        dump(Post::doesntHave('tags')->get());

        //return 'OK';

        $posts = Post::withCount('tags')->get();

        foreach ($posts as $post) {
            echo $post->title . ' - '. $post->tags_count, '<br>';
        }*/


        /*$post = new Post([
            'title' => 'Post4.',
            'slug' => '444',
            'tagline' => '444444'
        ]);

        $user = User::find(1);
        $user->posts()->save($post);*/

        /*User::find(1)->posts()->create([
            'title' => 'Post5',
            'slug' => '555',
            'tagline' => '555555'
        ]);*/


        /*try {
            Post::find(5)
                ->tags()
                ->attach(2);
        } catch (\Exception $e) {}

        Post::find(5)
            ->tags()
            ->detach(Tag::where('name', 'Новость')->first()->id);*/

        Post::find(1)
            ->tags()
            ->sync([
                Tag::where('name', 'Новость')->first()->id,
                Tag::where('name', 'Просто тэг')->first()->id
            ]);

        return 'OK';

    }
}
