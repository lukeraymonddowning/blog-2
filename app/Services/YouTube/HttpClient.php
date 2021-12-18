<?php

declare(strict_types=1);

namespace App\Services\YouTube;

use App\Contracts\Services\YouTube;
use App\Models\Video;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

final class HttpClient implements YouTube
{
    public function __construct(
        private string $apiKey,
        private string $channelId,
    ) {
    }

    /**
     * @return Collection<Video>
     */
    public function importVideos(): Collection
    {
        $options = [
            'channelId' => $this->channelId,
            'part' => 'snippet',
            'order' => 'date',
            'publishedAfter' => Carbon::parse('1st July 2021')->toRfc3339String(),
        ];

        return $this->fetch('search', $options, 'items')
            ->map(fn (array $data) => Video::query()->updateOrCreate([
                'id' => $data['id']['videoId'],
            ], [
                'title' => $data['snippet']['title'],
                'description' => $data['snippet']['description'],
                'thumbnail' => $data['snippet']['thumbnails']['medium']['url'],
                'published_at' => Carbon::parse($data['snippet']['publishedAt'])->toDateTimeString(),
            ]));
    }

    /**
     * @param array<string, mixed> $params
     */
    private function fetch(string $endpoint, array $params = [], string $key = null): Collection
    {
        return Http::asJson()
            ->baseUrl('https://youtube.googleapis.com/youtube/v3/')
            ->get($endpoint, array_merge($params, ['key' => $this->apiKey]))
            ->collect($key);
    }
}
