<?php

namespace Database\Factories;

use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Video>
 */
class VideoFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'thumbnail' => $this->faker->imageUrl,
            'published_at' => now()->subWeek(),
        ];
    }

    /**
     * Returns a representation of the factory as though it had come
     * from the YouTube API. If you have requested multiple models,
     * they will be returned wrapped in a "complete" response.
     *
     * @return array<string, mixed>
     */
    public function asYoutubeApiResponse(): array
    {
        $results = $this->make();

        if ($results instanceof Video) {
            return $this->getYoutubeApiVideoResponse($results);
        }

        return [
            'kind' => 'youtube#videoListResponse',
            'etag' => $this->faker->unique()->uuid,
            'regionCode' => 'GB',
            'pageInfo' => [
                'totalResults' => $results->count(),
                'resultsPerPage' => $results->count(),
            ],
            'items' => $results->map(fn (Video $video) => $this->getYoutubeApiVideoResponse($video))->all()
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function getYoutubeApiVideoResponse(Video $video): array
    {
        return [
            'kind' => 'youtube#searchResult',
            'etag' => $this->faker->unique()->uuid,
            'id' => [
                'kind' => 'youtube#video',
                'videoId' => $video->id,
            ],
            'snippet' => [
                'publishedAt' => $video->published_at->toIso8601String(),
                'channelId' => $this->faker->uuid,
                'title' => $video->title,
                'description' => $video->description,
                'thumbnails' => [
                    'default' => [
                        'url' => $video->thumbnail,
                        'width' => 120,
                        'height' => 90,
                    ],
                    'medium' => [
                        'url' => $video->thumbnail,
                        'width' => 320,
                        'height' => 180,
                    ],
                    'high' => [
                        'url' => $video->thumbnail,
                        'width' => 480,
                        'height' => 360,
                    ],
                ],
                'channelTitle' => 'Luke Downing',
                'liveBroadcastContent' => 'none',
                'publishTime' => $video->published_at->toIso8601String(),
            ],
        ];
    }
}
