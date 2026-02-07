<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
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
            'email' => 'required|string|max:200|user:unique',
            'password' => 'required|string|min:8|max:200',
        ]);
        $user = User::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => Hash::make($validate['password'])
        ]);

        $token = $user->createToken($request->name);

        return [
            'user' => $user,
            'token' => $token,
        ];
    }
}
