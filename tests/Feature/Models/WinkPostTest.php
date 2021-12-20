<?php

declare(strict_types=1);

use App\Jobs\SendTweetAboutPublishedPost;
use Database\Factories\WinkPostFactory;
use Illuminate\Support\Facades\Queue;

it('schedules a tweet for the posts publish date when a post is published', function () {
    Queue::fake();

    $post = WinkPostFactory::new()->unpublished()->create();
    $post->fill([
        'published' => true,
        'publish_date' => now()->addDay()->startOfDay(),
    ])->save();

    /*
     * The tweet should be scheduled for the post's publish date plus
     * one second, which ensures the queued job is not fired before
     * the post is classed as 'published'.
     */
    Queue::assertPushed(SendTweetAboutPublishedPost::class, function (SendTweetAboutPublishedPost $job) use ($post) {
        return $post->publish_date->addSecond()->equalTo($job->delay);
    });
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
