<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Nedwors\Navigator\Facades\Nav;

class NavigationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Nav::define(fn () => [
            Nav::item('Home')->for('home'),
            Nav::item('Blog')->for('posts.index'),
            Nav::item('Twitter')->for(config('social.twitter')),
            Nav::item('GitHub')->for(config('social.github')),
            Nav::item('YouTube')->for(config('social.youtube')),
        ]);
    }
}
