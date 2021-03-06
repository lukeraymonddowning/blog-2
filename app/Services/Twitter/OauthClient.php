<?php

declare(strict_types=1);

namespace App\Services\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Contracts\Services\Twitter;

final class OauthClient implements Twitter
{
    public function __construct(private TwitterOAuth $client)
    {
    }

    public function tweet(string $message): void
    {
        $this->client->post('tweets', ['text' => $message], true);
    }
}
