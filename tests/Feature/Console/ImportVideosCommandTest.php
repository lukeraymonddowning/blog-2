<?php

declare(strict_types=1);

use App\Contracts\Services\YouTube;
use Tests\Doubles\FakeYoutubeClient;

it('imports videos', function () {
    $this->swap(YouTube::class, $youtube = new FakeYoutubeClient());

    $this->artisan('site:import-videos')->assertSuccessful();

    $youtube->assertVideosImported();
});
