<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    // Function login API
    public function login(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string',
        ]);
        if (!$validator->fails()) {
            $user = User::where('email', $request->get('email'))->first();
            if (Hash::check($request->get('password'), $user->password)) {
                // Create a new token from the new login request
                return $this->generateToken($user);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Password is not correct'
                ], 400);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'There is an error in the email or password'
            ], 400);
        }
    }

    // Create a new token from the new login request
    private function generateToken(User $user)
    {
        $token = $user->createToken('User')->accessToken;
        $user->setAttribute('token', $token);

        return response()->json([
            'status' => true,
            'message' => 'Logged in Successfully',
            'data' => $user
        ], 200);
    }

    // Function logout
    public function logout(request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return response()->json([
            'status' => true,
            'message' => 'You have successfully logout!!',
        ], 200);
    }
}
