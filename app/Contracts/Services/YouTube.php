<?php

declare(strict_types=1);

namespace App\Contracts\Services;

use App\Models\Video;
use Illuminate\Support\Collection;

interface YouTube
{
    /**
     * @return Collection<Video>
     */
    public function importVideos(): Collection;
}
