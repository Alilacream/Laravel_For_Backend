<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\User;

class Register extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email', // Table name first, then column
            'password' => 'required|confirmed',
        ]);
        $user = User::create($validate);

        // read from the laravel sanctum docks to create your token.

        $token = $user->createToken($request->name);
        // set the expiration date for the token:
        $token->expires_at = Carbon::now()->addDays(7);
        // saving the token
        $token->token->save();

        // we show the json format
        return [
            'user' => $user,
            'token' => $token->plainTextToken,
        ];
    }
}
