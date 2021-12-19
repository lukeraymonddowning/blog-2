<?php

namespace App\Contracts\Services;

interface Twitter
{

    public function tweet(string $message): void;

}
