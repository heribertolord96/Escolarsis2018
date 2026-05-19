<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService,
    ) {}

    public function login(LoginRequest $request): JsonResponse
    {
        $issueToken = $request->boolean('token', false)
            || $request->filled('device_name');

        $result = $this->authService->login(
            $request->validated('email'),
            $request->validated('password'),
            $issueToken,
        );

        $payload = [
            'user' => new UserResource($result['user']),
        ];

        if ($result['token']) {
            $payload['token'] = $result['token'];
        }

        return response()->json($payload);
    }

    public function logout(Request $request): JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = $request->user();
        $this->authService->logout($user);

        return response()->json(['message' => 'Logged out']);
    }

    public function me(Request $request): UserResource
    {
        return new UserResource($request->user()->load('roles'));
    }
}
