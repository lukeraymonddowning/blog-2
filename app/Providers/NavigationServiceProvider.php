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
            Nav::item('Twitter')->for('https://twitter.com/LukeDowning19'),
            Nav::item('GitHub')->for('https://github.com/lukeraymonddowning'),
            Nav::item('YouTube')->for('https://www.youtube.com/channel/UCQIrK03uD-T69usLC8o3Spg'),
        ]);
    }
}
