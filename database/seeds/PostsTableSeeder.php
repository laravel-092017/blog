<?php

use App\Models\Post;
use Illuminate\Database\Seeder,
    Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$faker = Faker\Factory::create('ru_RU');
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $postModel = Post::create([
                'title' => $faker->realText(50),
                'tagline' => $faker->realText(30),
                //'image' => 'https://imgholder.ru/1280x720/0082d5/eceff4&text=%D0%9A%D0%B0%D1%80%D1%82%D0%B8%D0%BD%D0%BA%D0%B0%20%D0%B1%D0%BB%D0%BE%D0%B3%D0%B0&font=kelson',
                'image' => 'https://picsum.photos/1280/720?random',
                'slug' => sha1(str_random(16) . microtime(true)),
                'announce' => $faker->realText(300),
                'fulltext' => $faker->realText(1024),
                'active_from' => Carbon::now(),
                'views_count' => mt_rand(0,100),
            ]);

            $postModel->slug = $postModel->id . ':' . str_slug($postModel->title, '-');
            $postModel->save();
        }

        $favPost = Post::find(mt_rand(1,10));
        $favPost->is_favorite = 1;
        $favPost->save();
    }
}
