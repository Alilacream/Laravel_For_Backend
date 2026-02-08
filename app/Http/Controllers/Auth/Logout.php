<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Logout extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
    // PERF:Delete the current user's token
     $request->user()->tokens()->delete();
    // returning the success message responce, no errors to handle.
     return ([
     "message" => "Succesfully logged Out",
     "Status" => 200
    ]);
    }

}
