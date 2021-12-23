<?php

declare(strict_types=1);

namespace App\Services\Register;

use App\Contracts\Services\Register;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

final class DatabaseRegister implements Register
{
    public function markPresent(Request $request): string
    {
        return Visit::query()->firstOrCreate([
            'device_key' => md5("{$request->ip()}_{$request->userAgent()}"),
            'url' => $request->url(),
        ], [
            'id' => Str::uuid()->toString(),
        ])->id;
    }

    public function markCompleted(string $token): void
    {
        Visit::query()->where('id', $token)->update(['completed_at' => now()]);
    }
}
