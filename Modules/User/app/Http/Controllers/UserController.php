<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Modules\User\Http\Requests\LoginRequest;
use Modules\User\Http\Requests\RegisterRequest;
use Modules\User\Models\User;

class UserController extends Controller
{
    public function register(RegisterRequest $request): array
    {
        $input = $request->validated();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['password'],
            'phone_code' => $input['phone_code'],
            'phone_number' => $input['phone_number'],
            'email_verified_at' => null,
            'points' => 0,
        ]);

        return [
            'status' => true,
            'message' => "Registered Succesfully!",
        ];
    }

    public function login(LoginRequest $request): array
    {
        $credentials = $request->validated();

        if (!auth()->attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials'],
            ]);
        }

        $user = auth()->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'token' => $token,
            'token_type' => "Bearer"
        ];
    }
}
