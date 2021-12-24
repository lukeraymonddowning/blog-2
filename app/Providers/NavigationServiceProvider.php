<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Nedwors\Navigator\Facades\Nav;

final class NavigationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Nav::define(fn () => [
            Nav::item('Home')->for('home'),
            Nav::item('Blog')->for('posts.index'),
            Nav::item('Sponsor')->for('https://github.com/sponsors/lukeraymonddowning'),
        ]);

        Nav::define(fn () => [
            Nav::item('Twitter')->icon('ri-twitter-line')->for(strval(config('social.twitter')))->meta([
                'footerClass' => 'hover:text-blue-400',
            ]),
            Nav::item('GitHub')->icon('ri-github-line')->for(strval(config('social.github')))->meta([
                'footerClass' => 'hover:text-zinc-500 hover:dark:text-zinc-50',
            ]),
            Nav::item('YouTube')->icon('ri-youtube-line')->for(strval(config('social.youtube')))->meta([
                'footerClass' => 'hover:text-red-500',
            ]),
        ], 'social');
    }
}
