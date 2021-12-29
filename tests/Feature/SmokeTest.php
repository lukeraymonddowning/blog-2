<?php

declare(strict_types=1);

use App\Models\Video;
use Database\Factories\WinkAuthorFactory;
use Database\Factories\WinkPostFactory;
use Illuminate\Support\Facades\URL;
use Wink\WinkPost;

beforeEach(function () {
    WinkPostFactory::new()->count(3)->create();
    Video::factory()->count(3)->create();
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
        ->assertForbidden();
});

it('allows access to preview using a secure link', function () {
    WinkPostFactory::new()->create();
    $link = URL::signedRoute('posts.preview', ['post' => WinkPost::query()->first()]);

    $this->get($link)->assertOk();
});

it('allows authors to see preview', function () {
    $this->actingAs(WinkAuthorFactory::new()->create(), 'wink')
        ->get(route('posts.preview', WinkPost::query()->first()))
        ->assertOk();
});

it('successfully loads the atom feed', function () {
    WinkPostFactory::new()->count(3)->create();

    $this->get('/feed')->assertOk();
});

it('successfully loads the atom feed when a post has no image', function () {
    WinkPostFactory::new()->create(['featured_image' => null]);

    $this->get('/feed')->assertOk();
});
