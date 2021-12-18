<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\Services\YouTube;
use App\Services\YouTube\HttpClient;
use Carbon\CarbonImmutable;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\ServiceProvider;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\PingCheck;
use Spatie\Health\Facades\Health;

final class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(YouTube::class, function (Container $container) {
            // @phpstan-ignore-next-line
            $config = $container['config']->get('services.youtube');

            return new HttpClient($config['key'], $config['channel_id']);
        });
    }

    public function boot(): void
    {
        Model::unguard();
        Model::preventLazyLoading();
        Relation::enforceMorphMap([]);
        Date::useClass(CarbonImmutable::class);

        Health::checks([
            DatabaseCheck::new(),
            DebugModeCheck::new(),
            EnvironmentCheck::new(),
            PingCheck::new()->url('https://downing.tech/')->label('Homepage'),
        ]);
    }
}
