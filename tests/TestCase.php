<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use LazilyRefreshDatabase;

    protected function afterRefreshingDatabase(): void
    {
        Artisan::call('migrate', [
            '--path' => 'vendor/themsaid/wink/src/Migrations',
        ]);
    }
}
