<?php

declare(strict_types=1);

use Database\Factories\WinkAuthorFactory;
use Database\Factories\WinkPostFactory;
use Wink\WinkPost;

beforeEach(function () {
    WinkPostFactory::new()->count(3)->create();
});

it('loads the home page', function () {
    $this->get(route('home'))->assertOk();
});

it('loads the posts index page', function () {
    $this->get(route('posts.index'))->assertOk();
});

it('loads the posts show page', function () {
    $this->get(route('posts.show', WinkPost::query()->first()))->assertOk();
});

it('can search for posts', function () {
    $this->get(route('posts.index', ['search' => 'a']))->assertOk();
});

it('stops guests seeing preview', function () {
    $this->get(route('posts.preview', WinkPost::query()->first()))
        ->assertRedirect(route('login'));
});

it('allows authors to see preview', function () {
    $this->actingAs(WinkAuthorFactory::new()->create(), 'wink')
        ->get(route('posts.preview', WinkPost::query()->first()))
        ->assertOk();
});
