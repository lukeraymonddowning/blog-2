<?php

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
