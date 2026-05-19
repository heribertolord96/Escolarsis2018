<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService
{
    /**
     * @return array{user: User, token: string|null}
     */
    public function login(string $email, string $password, bool $issueToken = false): array
    {
        if (! Auth::attempt(['email' => $email, 'password' => $password, 'is_active' => true])) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        /** @var User $user */
        $user = Auth::user();
        $user->load('roles');

        return [
            'user' => $user,
            'token' => $issueToken ? $user->createToken('api')->plainTextToken : null,
        ];
    }

    public function logout(User $user): void
    {
        $user->currentAccessToken()?->delete();
        Auth::guard('web')->logout();
    }
}
