<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use \App\Traits\CommonTrait;

class AuthController extends Controller
{
    use CommonTrait;
    public function register(Request $request) {
        $this->customLog("111111");
//        $data = $request->validate([
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255|unique:users',
//            'password' => [
//                'required',
//                'confirmed',
//                Password::min(8)->mixedCase()->numbers()->symbols()
//            ],
//        ]);
//
//        $user = User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => bcrypt($data['password'])
//        ]);
//        $token = $user->createToken('main')->plainTextToken;
//
//        return response([
//            'user' => $user,
//            'token' => $token
//        ]);


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->mixedCase()->numbers()->symbols()
            ],
        ]);

        $this->customLog("222222");

        if($validator->fails()) {
            $this->customLog($validator->errors());
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
        $this->customLog("aaaaaaaaa");
        $post_data = $request->all();
        $user = User::create([
            'name' => $post_data['name'],
            'email' => $post_data['email'],
            'password' => bcrypt($post_data['password'])
        ]);
        $token = $user->createToken('main')->plainTextToken;

        return response([
            'status' => true,
            'user' => $user,
            'token' => $token
        ]);

    }

     public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email|string|exists:users,email',
            'password' => [
                'required'
            ],
            'remember' => 'boolean'
        ]);

        $remember = $credentials['remember'] ?? false;
        unset($credentials['remember']);

        if (!Auth::attempt($credentials, $remember)) {
            return response([
                'error' => 'The Provided credentials are not correct'
            ], 422);
        }

        $user = Auth::user();
        $token = $user->createToken('main')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout() {
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return response([
            'success' => true
        ]);
    }

}