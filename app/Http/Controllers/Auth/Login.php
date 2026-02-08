<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Login extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // in validation, we want to ensure that the email EXISTS! not unique.
        $validate = $request->validate([
            "email" => "required|email|exists:users",
            "password" => "required"
        ]);
        // grep the first user in the database (User Model)
        $user = User::where('email', $validate['email'])->first();
        // checking the password.
        if (! Hash::check($validate['password'],$user->password )){
            return [
                "message" => "Provided Password is Incorrect"
            ];
        }
        $token = $user->createToken($user->name);
        return [
            "Message" => "Login successfully!",
            "token" => $token->plainTextToken
        ];
    }
}
