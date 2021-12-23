<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\Services\Register;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;
use Wink\WinkPost;

final class PostController extends Controller
{
    public function index(Request $request): View
    {
        return view('posts.index', [
            'content' => Str::markdown(\Safe\file_get_contents(resource_path('markdown/blog.md'))),
            'search' => $request->input('search'),
            'posts' => WinkPost::query()
                ->when(
                    $request->filled('search'),
                    fn (Builder $query) => $query
                        ->where('title', 'like', "%{$request->input('search')}%")
                        ->orWhere('body', 'like', "%{$request->input('search')}%")
                )
                ->live()
                ->published()
                ->orderByDesc('publish_date')
                ->paginate(10),
        ]);
    }

    public function show(Request $request, WinkPost $post, Register $register): View
    {
        abort_unless($post->published, Response::HTTP_NOT_FOUND);
        abort_if($post->publish_date->isFuture(), Response::HTTP_NOT_FOUND);

        $token = $register->markPresent($request);

        return view('posts.show', [
            'post' => $post,
            'token' => $token,
        ]);
    }

    public function preview(WinkPost $post): View
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }
}
