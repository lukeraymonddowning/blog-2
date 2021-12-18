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
            Nav::item('Twitter')->for(strval(config('social.twitter'))),
            Nav::item('GitHub')->for(strval(config('social.github'))),
            Nav::item('YouTube')->for(strval(config('social.youtube'))),
        ]);
    }
}
