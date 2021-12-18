<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string          $id
 * @property string          $title
 * @property string          $description
 * @property string          $thumbnail
 * @property string          $url
 * @property CarbonImmutable $published_at
 */
final class Video extends Model
{
    use HasFactory;

    public $incrementing = false;

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function getUrlAttribute(): string
    {
        return "https://www.youtube.com/watch?v={$this->id}";
    }
}
