<?php

declare(strict_types=1);

namespace Tests\Doubles;

use App\Contracts\Services\YouTube;
use Illuminate\Support\Collection;
use PHPUnit\Framework\Assert;

final class FakeYoutubeClient implements YouTube
{
    public bool $importRequested = false;

    public function importVideos(): Collection
    {
        $this->importRequested = true;

        return collect();
    }

    public function assertVideosImported(): void
    {
        Assert::assertTrue(
            $this->importRequested,
            'The importVideos method was never called.'
        );
    }
}
