<?php

namespace App\Services\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Manager;
use Tests\Doubles\FakeTwitterClient;

class TwitterManager extends Manager
{

    public function getDefaultDriver(): string
    {
        return $this->configOptions()['driver'] ?? 'null';
    }

    public function createOauthDriver(): Oauth
    {
        $options = $this->configOptions();

        return new Oauth(new TwitterOAuth(
            $options["consumer_key"],
            $options["consumer_secret"],
            $options["access_token"],
            $options["access_token_secret"]
        ));
    }

    public function createNullDriver(): FakeTwitterClient
    {
        return new FakeTwitterClient();
    }

    /**
     * @return array{ driver: string|null, consumer_key: string, consumer_secret: string, access_token: string, access_token_secret: string }
     */
    private function configOptions(): array
    {
        return $this->config->get('services.twitter');
    }
}
