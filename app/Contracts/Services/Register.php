<?php

declare(strict_types=1);

namespace App\Contracts\Services;

use Illuminate\Http\Request;

interface Register
{
    /**
     * Register a visit for the given request. You will receive
     * a token that can be passed to markCompleted which will
     * indicate that the visitor has 'finished' the page.
     */
    public function markPresent(Request $request): string;

    /**
     * Pass a token provided by markPresent to mark the visitor
     * as having 'finished' the page. For example, they may
     * have reached the end of a blog post.
     */
    public function markCompleted(string $token): void;
}
