<?php

declare(strict_types=1);

use App\Contracts\Services\Twitter;

it('sends a tweet', function () {
    $this->expectNotToPerformAssertions();

    config()->set('services.twitter.driver', 'oauth');
    $twitter = $this->app->make(Twitter::class);

    $twitter->tweet('Hello world! This is just a little test, move along 😉');
})->group('integration');
