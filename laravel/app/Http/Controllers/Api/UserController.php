<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        $user = User::query()->where('email', $credentials['email'])->first();
        if ($user && Hash::check($credentials['password'], $user->password)) {

            $token = $user->createToken('API')->plainTextToken;

            return response()->json([
                'token' => $token,
                'user' => $user
            ], 200);
        }
        return response()->json(['error' => 'Invalid Credentials'], 401);
    }

}
