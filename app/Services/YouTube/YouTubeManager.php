<?php

declare(strict_types=1);

namespace App\Services\YouTube;

use Illuminate\Support\Manager;
use Tests\Doubles\FakeYoutubeClient;

final class YouTubeManager extends Manager
{
    public function getDefaultDriver(): string
    {
        return $this->configOptions()['driver'] ?? 'null';
    }

    public function createNullDriver(): FakeYoutubeClient
    {
        return new FakeYoutubeClient();
    }

    public function createHttpDriver(): HttpClient
    {
        $config = $this->configOptions();

        return new HttpClient($config['key'], $config['channel_id']);
    }

    /**
     * @return array{ driver: string|null, key: string, channel_id: string }
     */
    private function configOptions(): array
    {
        // @phpstan-ignore-next-line
        return $this->config->get('services.youtube');
    }
}
