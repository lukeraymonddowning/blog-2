<?php

declare(strict_types=1);

namespace App\Services\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Manager;
use Tests\Doubles\FakeTwitterClient;

final class TwitterManager extends Manager
{
    public function getDefaultDriver(): string
    {
        return $this->configOptions()['driver'] ?? 'null';
    }

    public function createOauthDriver(): OauthClient
    {
        $options = $this->configOptions();

        return new OauthClient(new TwitterOAuth(
            $options['consumer_key'],
            $options['consumer_secret'],
            $options['access_token'],
            $options['access_token_secret']
        ));
    }

    public function createNullDriver(): FakeTwitterClient
    {
        return new FakeTwitterClient();
    }

    /**
     * @return array{ driver: string|null, consumer_key: string, consumer_secret: string|null, access_token: string, access_token_secret: string|null }
     */
    private function configOptions(): array
    {
        return $this->config->get('services.twitter');
    }
}
