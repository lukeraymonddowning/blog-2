<?php

declare(strict_types=1);

use App\Contracts\Services\Register;
use Database\Factories\WinkPostFactory;

it('registers a visit', function () {
    $register = $this->app->get(Register::class);

    $post = WinkPostFactory::new()->create();

    $this->get(route('posts.show', $post->slug))
        ->assertOk();

    $register->assertPresent(request());
});

it('passes the given visit token to the view', function () {
    $this->app->get(Register::class)->forceToken('foo');

    $post = WinkPostFactory::new()->create();

    $this->get(route('posts.show', $post->slug))
        ->assertViewHas('token', 'foo');
});
