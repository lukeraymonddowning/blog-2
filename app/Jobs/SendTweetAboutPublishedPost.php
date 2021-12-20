<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Contracts\Services\Twitter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Wink\WinkPost;

final class SendTweetAboutPublishedPost implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(private WinkPost $post)
    {
    }

    public function handle(Twitter $twitter): void
    {
        if ($this->postIsPublic() === false) {
            return;
        }

        $postUrl = route('posts.show', $this->post->slug);

        $twitter->tweet("New blog post available 📬: {$this->post->title}\n\n{$postUrl}");
    }

    private function postIsPublic(): bool
    {
        if ($this->post->published === false) {
            return false;
        }

        if ($this->post->publish_date->isFuture()) {
            return false;
        }

        return true;
    }
}
