<?php

declare(strict_types=1);

use App\Jobs\SendTweetAboutPublishedPost;
use Database\Factories\WinkPostFactory;
use Illuminate\Support\Facades\Queue;

it('schedules a tweet when a post is published', function () {
    Queue::fake();

    $post = WinkPostFactory::new()->unpublished()->create();
    $post->fill(['published' => true])->save();

    Queue::assertPushed(SendTweetAboutPublishedPost::class);
});

it('does not schedule a tweet if the post was already published', function () {
    Queue::fake();

    $post = WinkPostFactory::new()->create();
    $post->fill(['published' => true])->save();

    Queue::assertNotPushed(SendTweetAboutPublishedPost::class);
});

it('does not schedule a tweet if the post is still not published', function () {
    Queue::fake();

    $post = WinkPostFactory::new()->unpublished()->create();
    $post->fill(['published' => false])->save();

    Queue::assertNotPushed(SendTweetAboutPublishedPost::class);
});
