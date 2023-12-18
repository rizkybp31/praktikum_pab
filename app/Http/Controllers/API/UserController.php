<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;

class UserController extends Controller
{
    use PasswordValidationRules;
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);
            $user = User::where('email', $request->email)->first();
            if (!Hash::check($request->password, $user->password, [])) {
                return response()->json(['message' => 'Invalid credentials'], 500);
            }
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer', 'user' => $user
            ], 200);
        } catch (Exception $err) {
            return response()->json([
                'message' => 'An error has occured',
                'error' => $err
            ], 500);
        }
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => $this->passwordRules()
            ]);
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'house_number' => $request->house_number,
                'phone_number' => $request->phone_number,
                'city' => $request->city,
                'password' => Hash::make($request->password),
            ]);
            $user = User::where('email', $request->email)->first();
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer', 'user' => $user
            ], 200);
        } catch (Exception $err) {
            return response()->json([
                'message' => 'An error has occured',
                'error' => $err
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Token Revoked'], 200);
    }
    public function updateProfile(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();
        $user->update($data);
        return response()->json(['message' => 'Profile Updated'], 200);
    }
    public function fetch(Request $request)
    {
        return response()->json([
            'message' => 'Data profile user berhasil diambil',
            'user' => $request->user()
        ], 200);
    }
}
