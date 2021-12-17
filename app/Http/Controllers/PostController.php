<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Wink\WinkPost;

class PostController extends Controller
{
    public function index(): View
    {
        return view('posts.index', [
            'content' => Str::markdown(file_get_contents(resource_path('markdown/blog.md'))),
            'posts' => WinkPost::query()
                ->live()
                ->published()
                ->orderByDesc('publish_date')
                ->paginate(10),
        ]);
    }

    public function show(WinkPost $post): View
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }
}
