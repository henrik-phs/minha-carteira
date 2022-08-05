<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function account()
    {
        $user = auth()->user();

        return view("account", [
            'user' => $user
        ]);
    }
}
