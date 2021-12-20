<?php

declare(strict_types=1);

use App\Contracts\Services\Twitter;
use App\Jobs\SendTweetAboutPublishedPost;
use Database\Factories\WinkPostFactory;
use Tests\Doubles\FakeTwitterClient;

it('sends a tweet about the published post', function () {
    $this->swap(Twitter::class, $twitter = new FakeTwitterClient());
    $post = WinkPostFactory::new()->create(['title' => 'Getting started with Pest PHP']);
    $postUrl = route('posts.show', $post->slug);

    SendTweetAboutPublishedPost::dispatchSync($post);

    $twitter->assertTweeted(<<<TXT
    New blog post available 📬: Getting started with Pest PHP

    $postUrl
    TXT);
});

it('will not send a tweet if the post is no longer published', function () {
    $this->swap(Twitter::class, $twitter = new FakeTwitterClient());
    $post = WinkPostFactory::new()->create([
        'published' => false,
        'publish_date' => now()->subDay(),
    ]);

    SendTweetAboutPublishedPost::dispatchSync($post);

    $twitter->assertNothingTweeted();
});

it('will not send a tweet if the post is no longer live', function () {
    $this->swap(Twitter::class, $twitter = new FakeTwitterClient());
    $post = WinkPostFactory::new()->create([
        'published' => true,
        'publish_date' => now()->addDay(),
    ]);

    SendTweetAboutPublishedPost::dispatchSync($post);

    $twitter->assertNothingTweeted();
});
