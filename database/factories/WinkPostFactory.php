<?php

namespace Database\Factories;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Wink\WinkPost;
use function Safe\file_get_contents;

class WinkPostFactory extends Factory
{
    protected $model = WinkPost::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique->uuid,
            'slug' => $this->faker->unique->slug,
            'title' => $this->faker->sentence,
            'excerpt' => fn (array $attributes) => Str::limit($attributes['body'], 80),
            'body' => $this->content(),
            'markdown' => true,
            'published' => true,
            'publish_date' => now()->subDay(),
            'featured_image' => asset('images/thinking_about_code.svg'),
            'featured_image_caption' => '',
            'author_id' => WinkAuthorFactory::new(),
        ];
    }

    public function scheduled(CarbonInterface $publishDate = null): self
    {
        return $this->state([
            'published' => true,
            'publish_date' => $publishDate ?? now()->addDay(),
        ]);
    }

    public function unpublished(CarbonInterface $publishDate = null): self
    {
        return $this->state([
            'published' => false,
            'publish_date' => $publishDate ?? now()->addDay(),
        ]);
    }

    private function content(): string
    {
        return file_get_contents(base_path('tests/Fixtures/fake_post.md'));
    }
}
