<?php

declare(strict_types=1);

namespace App\Services\Register;

use Illuminate\Support\Manager;
use Tests\Doubles\FakeRegister;

final class RegisterManager extends Manager
{
    public function getDefaultDriver(): string
    {
        // @phpstan-ignore-next-line
        return $this->config->get('services.register.default') ?? 'null';
    }

    public function createDatabaseDriver(): DatabaseRegister
    {
        return new DatabaseRegister();
    }

    public function createNullDriver(): FakeRegister
    {
        return new FakeRegister();
    }
}
