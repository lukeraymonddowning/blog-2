<?php

declare(strict_types=1);

namespace Tests\Doubles;

use App\Contracts\Services\Twitter;
use PHPUnit\Framework\Assert;

final class FakeTwitterClient implements Twitter
{
    /**
     * @var array<int, string>
     */
    private array $sentTweets = [];

    public function tweet(string $message): void
    {
        $this->sentTweets[] = $message;
    }

    public function assertTweeted(string $tweet): void
    {
        Assert::assertContains(
            $tweet,
            $this->sentTweets,
            "The tweet \"{$tweet}\" was never sent."
        );
    }

    public function assertNothingTweeted(): void
    {
        $sentTweetCount = count($this->sentTweets);

        Assert::assertCount(0, $this->sentTweets, "[{$sentTweetCount}] tweets were sent.");
    }
}
