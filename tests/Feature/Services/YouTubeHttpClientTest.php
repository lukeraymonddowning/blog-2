<?php

declare(strict_types=1);

use App\Contracts\Services\YouTube;
use App\Models\Video;
use App\Services\YouTube\HttpClient;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    $this->youtube = $this->app->make(YouTube::class);
});

it('is the default implementation', function () {
    expect($this->youtube)->toBeInstanceOf(HttpClient::class);
});

it('can retrieve my videos and store them', function () {
    Http::fake(['*/search*' => Video::factory()->count(6)->asYoutubeApiResponse()]);

    $this->youtube->importVideos();

    $this->assertDatabaseCount(Video::class, 6);
});
