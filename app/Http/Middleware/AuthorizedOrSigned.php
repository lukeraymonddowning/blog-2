<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\ValidateSignature;

final class AuthorizedOrSigned
{
    public function __construct(private ValidateSignature $validateSignature)
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param string ...$guards
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (count($guards) === 0) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if ($request->user($guard)) {
                return $next($request);
            }
        }

        return $this->validateSignature->handle($request, $next);
    }
}
