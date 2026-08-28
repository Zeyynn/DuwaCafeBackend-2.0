<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Modules\User\Http\Requests\LoginRequest;
use Modules\User\Http\Requests\RegisterRequest;
use Modules\User\Http\Requests\VerifyCodeRequest;
use Modules\User\Models\User;
use Modules\User\Models\VerificationCode;

class AuthController extends Controller
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

    public function sendEmailVerification(): array
    {
        $user = $this->authenticatedUser();
        $code = $this->issueVerificationCode($user, 'email');

        return [
            'status' => true,
            'message' => 'Verification code sent to email.',
            'data' => ['code' => $code],
        ];
    }

    public function sendPhoneVerification(): array
    {
        $user = $this->authenticatedUser();
        $code = $this->issueVerificationCode($user, 'phone');

        return [
            'status' => true,
            'message' => 'Verification code sent to phone.',
            'data' => ['code' => $code],
        ];
    }

    public function verifyEmail(VerifyCodeRequest $request): array
    {
        $user = $this->authenticatedUser();
        $this->consumeVerificationCode($user, 'email', $request->validated()['code']);
        $user->forceFill(['email_verified_at' => now()])->save();

        return [
            'status' => true,
            'message' => 'Email verified successfully.',
        ];
    }

    public function verifyPhone(VerifyCodeRequest $request): array
    {
        $user = $this->authenticatedUser();
        $this->consumeVerificationCode($user, 'phone', $request->validated()['code']);
        $user->forceFill(['phone_verified_at' => now()])->save();

        return [
            'status' => true,
            'message' => 'Phone verified successfully.',
        ];
    }

    protected function consumeVerificationCode(User $user, string $type, string $code): VerificationCode
    {
        $verification = $user->verificationCodes()
            ->where('type', $type)
            ->where('code', $code)
            ->whereNull('used_at')
            ->where('expires_at', '>', now())
            ->latest()
            ->first();

        if (! $verification) {
            throw ValidationException::withMessages([
                'code' => ['This verification code is invalid or has expired.'],
            ]);
        }

        $verification->forceFill(['used_at' => now()])->save();

        return $verification;
    }

    protected function authenticatedUser(): User
    {
        $user = auth()->user();

        if (! $user) {
            throw ValidationException::withMessages([
                'auth' => ['You must be logged in to request a verification code.'],
            ]);
        }

        return $user;
    }

    protected function issueVerificationCode(User $user, string $type): string
    {
        $code = (string) random_int(100000, 999999);

        VerificationCode::create([
            'user_id' => $user->id,
            'type' => $type,
            'code' => $code,
            'expires_at' => now()->addMinutes(10),
        ]);

        return $code;
    }
}
