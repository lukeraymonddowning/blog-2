<?php

namespace App\Services\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;

class Oauth
{
    public function __construct(private TwitterOAuth $auth)
    {
    }
}
