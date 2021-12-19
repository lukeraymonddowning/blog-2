<?php

declare(strict_types=1);

namespace App\Providers;

use App\Jobs\SendTweetAboutPublishedPost;
use Illuminate\Support\ServiceProvider;
use Wink\WinkPost;

final class WinkServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        WinkPost::saved(function (WinkPost $post) {
            if ($post->published && $post->wasChanged('published')) {
                SendTweetAboutPublishedPost::dispatch($post);
            }
        });
    }
}
