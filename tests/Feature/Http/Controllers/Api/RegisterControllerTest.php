<?php

declare(strict_types=1);

use App\Contracts\Services\Register;

it('marks the given visit as complete', function () {
    $register = $this->app->get(Register::class);
    $token = $register->markPresent(request());

    $this->postJson(route('api.register.complete', [
        'token' => $token,
    ]))->assertOk();

    $register->assertCompleted($token);
});

it('throws a validation exception if no token is given', function () {
    $this->postJson(route('api.register.complete', [
        'token' => null,
    ]))->assertInvalid(['token' => 'required']);
});
