<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class VisitFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid()->toString(),
            'device_key' => fn ($attributes) => Hash::make($attributes['id']),
            'url' => fn() => route('posts.show', WinkPostFactory::new()->create()->slug),
            'completed_at' => null,
        ];
    }

    public function completed(): self
    {
        return $this->state(['completed_at' => now()]);
    }
}
