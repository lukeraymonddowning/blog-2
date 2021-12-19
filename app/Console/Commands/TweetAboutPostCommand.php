<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Contracts\Services\Twitter;
use Illuminate\Console\Command;
use Wink\WinkPost;

final class TweetAboutPostCommand extends Command
{
    protected $signature = 'tweet:about {post}';

    protected $description = 'Send out a tweet publicising the given post.';

    public function handle(Twitter $twitter): int
    {
        $post = WinkPost::query()->findOrFail($this->argument('post'));
        $postUrl = route('posts.show', $post->slug);

        $twitter->tweet("New blog post available 📬: {$post->title}\n\n{$postUrl}");

        $this->info('Tweet sent!');

        return Command::SUCCESS;
    }
}
