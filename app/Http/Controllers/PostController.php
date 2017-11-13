<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Section;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function postBySlug($slug)
    {
        try {
            $post = Post::where('slug', $slug)
                ->active()
                ->intime()
                ->firstOrFail();
        } catch (\Exception $e) {
            abort(404);
        }

        return view('layouts.secondary', [
            'page' => 'pages.post',
            'title' => $post->title,
            'post' => $post
        ]);
    }

    public function listByTag($tag)
    {
        try {
            $tag = Tag::where('name', $tag)
                ->firstOrFail();
        } catch (\Exception $e) {
            abort(404);
        }

        $posts = $tag->posts()
            ->active()
            ->intime()
            ->orderBy('id', 'DESC')
            ->paginate(config('blog.itemsPerPage'));

        return view('layouts.primary', [
            'page' => 'pages.main',
            'title' => 'Список статей по тегу ' . $tag,
            'image' => [
                'path' => 'assets/images/Me.jpg',
                'alt' => 'Image'
            ],
            'posts' => $posts,
        ]);
    }

    public function listBySection($section)
    {
        try {
            $section = Section::where('name', $section)
                ->firstOrFail();
        } catch (\Exception $e) {
            abort(404);
        }

        $posts = $section->posts()
            ->active()
            ->intime()
            ->orderBy('id', 'DESC')
            ->paginate(config('blog.itemsPerPage'));

        return view('layouts.primary', [
            'page' => 'pages.main',
            'title' => 'Список статей в разделе ' . $section,
            'image' => [
                'path' => 'assets/images/Me.jpg',
                'alt' => 'Image'
            ],
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        $this->authorize('create', Post::class);

        return view('layouts.primary', [
            'page' => 'pages.create',
            'title' => 'Создание нового поста',
        ]);
    }

    public function createPost(Request $request)
    {
        /*if (Gate::denies('create', Auth::user())) {
            abort(403);
        }*/

        $this->authorize('create', Post::class);

        $request['active_from'] = Carbon::now();
        $request['slug'] = sha1(str_random(16) . microtime(true));

        $postModel = Post::create($this->request->all());
        $postModel->slug = $postModel->id . ':' . str_slug($postModel->title, '-');
        $postModel->save();

        return redirect()->route('site.main.index');
    }
}
