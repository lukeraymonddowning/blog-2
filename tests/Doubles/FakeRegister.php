<?php

declare(strict_types=1);

namespace Tests\Doubles;

use App\Contracts\Services\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PHPUnit\Framework\Assert;

final class FakeRegister implements Register
{
    private string|null $token = null;

    /**
     * @var array<string, string>
     */
    private array $present = [];

    /**
     * @var array<int, string>
     */
    private array $completed = [];

    public function markPresent(Request $request): string
    {
        $deviceKey = $this->getDeviceKey($request);
        $token = $this->token ?? Str::uuid()->toString();

        $this->present[$deviceKey] ??= $token;

        return $this->present[$deviceKey];
    }

    public function markCompleted(string $token): void
    {
        $this->completed[] = $token;
    }

    public function forceToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function assertPresent(Request $request): self
    {
        Assert::assertArrayHasKey(
            $this->getDeviceKey($request),
            $this->present,
            'This request is not marked as present.'
        );

        return $this;
    }

    public function assertCompleted(string $token): self
    {
        Assert::assertContains(
            $token,
            $this->completed,
            'This token was not marked as completed.'
        );

        return $this;
    }

    private function getDeviceKey(Request $request): string
    {
        return md5("{$request->ip()}_{$request->userAgent()}");
    }
}
