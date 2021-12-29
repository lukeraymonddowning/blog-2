<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\URL;
use Wink\WinkPost;

final class CreateSignedPostUrlCommand extends Command
{
    protected $signature = 'site:link';

    protected $description = 'Create a signed post URL that allows a guest to view a preview post.';

    public function handle(): int
    {
        $postSlug = $this->choice('Which post would you like a URL for?', WinkPost::query()
            ->orderByDesc('created_at')
            ->limit(10)
            ->get()
            ->mapWithKeys(fn (WinkPost $post) => [$post->slug => $post->title])
            ->toArray()
        );

        $this->info(URL::signedRoute('posts.preview', ['post' => $postSlug]));

        return self::SUCCESS;
    }
}
