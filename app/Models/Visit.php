<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string               $id
 * @property string               $device_key   A unique key for the device the visit was made from.
 * @property string               $url          The URL the visit was made to.
 * @property CarbonImmutable|null $completed_at
 * @property CarbonImmutable      $updated_at
 * @property CarbonImmutable      $created_at
 */
final class Visit extends Model
{
    use HasFactory;

    public $incrementing = false;
}
