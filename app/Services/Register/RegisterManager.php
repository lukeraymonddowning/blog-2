<?php

namespace App\Services\Register;

use Illuminate\Support\Manager;
use Tests\Doubles\FakeRegister;

class RegisterManager extends Manager
{
    public function getDefaultDriver(): string
    {
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
