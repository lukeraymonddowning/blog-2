<?php

declare(strict_types=1);

namespace App\Contracts\Services;

interface Twitter
{
    public function tweet(string $message): void;
}
