<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {

            return $this->errorResponse("These credentials doesn't match any records",[], 401);
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        return $this->successResponse(
            ["token" => $token],
            'Successfully to login',
        );
    }

    public function logout(Request $request)
    {   
        $request->user()->tokens()->delete();
        return $this->successResponse([], 'Successfuly Logouted');
    }
}
