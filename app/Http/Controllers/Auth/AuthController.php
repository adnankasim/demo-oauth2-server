<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('login-page');
    }

    public function login(Request $request) {
        $request->validate([
             'email' => 'required|string|email',
             'password' => 'required|string'
        ]);

        $credentials = request(['email', 'password']);

        if(!auth()->attempt($credentials)){
            return response()->json([
                'message' => 'Unauthorized'
            ],401);
        }

        $token = auth()->user()->createToken('API Token')->accessToken;

        return response(['user' => auth()->user(), 'token' => $token]);
   }

   public function register(Request $request)
   {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $token = $user->createToken('API Token')->accessToken;

        return response(['user' => $user, 'token' => $token]);
   }

   public function logout(Request $request)
   {
        $request->user()->token()->revoke();
        return response()->json([
          'message' => 'Successfully logged out',
        ]);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

}
