<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Wink\WinkPost;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('home', [
            'content' => Str::markdown(file_get_contents(resource_path('markdown/home.md'))),
            'latestPosts' => WinkPost::query()
                ->published()
                ->live()
                ->orderByDesc('publish_date')
                ->limit(3)
                ->get(),
        ]);
    }
}
