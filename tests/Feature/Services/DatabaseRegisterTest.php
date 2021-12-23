<?php

use App\Models\Visit;
use App\Services\Register\RegisterManager;

beforeAll(function () {
    $_SERVER['REMOTE_ADDR'] = '123.0.0.1';
    $_SERVER['HTTP_USER_AGENT'] = 'testing';
});

beforeEach(function () {
    $this->register = (new RegisterManager($this->app))->driver('database');
});

it('can mark a request as a visit', function () {
    $token = $this->register->markPresent(request());

    expect(Visit::query()->find($token))->not->toBeNull();
});

it('will not create 2 visits from the same request ip user agent combo', function () {
    $request = request();

    $token = $this->register->markPresent($request);

    expect($this->register->markPresent($request))->toBe($token);
    expect(Visit::query()->count())->toBe(1);
});

it('can mark a request as completed', function () {
    $token = Visit::factory()->create()->id;

    $this->register->markCompleted($token);

    expect(Visit::query()->find($token)->completed_at)->not->toBeNull();
});
