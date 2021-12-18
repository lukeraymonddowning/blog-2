<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\View\View;
use Wink\WinkPost;

final class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('home', [
            'content' => Str::markdown(\Safe\file_get_contents(resource_path('markdown/home.md'))),
            'latestPosts' => WinkPost::query()
                ->published()
                ->live()
                ->orderByDesc('publish_date')
                ->limit(3)
                ->get(),
        ]);
    }
}
