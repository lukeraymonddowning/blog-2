<?php

declare(strict_types=1);

namespace App\Services\Feed;

use Illuminate\Support\Collection;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Wink\WinkPost;

final class FeedPost implements Feedable
{
    public function __construct(private WinkPost $post)
    {
    }

    public static function build(): Collection
    {
        return WinkPost::query()
            ->with('author')
            ->live()
            ->published()
            ->orderByDesc('publish_date')
            ->get()
            ->mapInto(self::class);
    }

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->post->id)
            ->title($this->post->title)
            ->summary($this->post->excerpt)
            ->image($this->post->featured_image)
            ->authorName($this->post->author->name)
            ->authorEmail($this->post->author->email)
            ->updated($this->post->updated_at)
            ->link(route('posts.show', $this->post->slug));
    }
}
