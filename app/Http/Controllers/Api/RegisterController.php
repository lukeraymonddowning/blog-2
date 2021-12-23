<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Contracts\Services\Register;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class RegisterController extends Controller
{
    public function complete(Request $request, Register $register): JsonResponse
    {
        $data = $request->validate([
            'token' => ['required', 'string'],
        ]);

        $register->markCompleted($data['token']);

        return response()->json();
    }
}
