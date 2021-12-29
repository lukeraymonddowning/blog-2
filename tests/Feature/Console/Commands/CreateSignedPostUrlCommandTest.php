<?php

declare(strict_types=1);

use Database\Factories\WinkPostFactory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\URL;

it('allows the user to pick a post and provides a url', function () {
    $posts = WinkPostFactory::new()->count(3)->create();

    URL::partialMock()
        ->shouldReceive('signedRoute')
        ->once()
        ->andReturn('https://foobar.com');

    $this->artisan('site:link')
        ->expectsChoice(
            'Which post would you like a URL for?',
            $posts->first()->getKey(),
            [...$posts->map->slug, ...$posts->map->title],
        )
        ->expectsOutput('https://foobar.com')
        ->assertExitCode(Command::SUCCESS);
});
