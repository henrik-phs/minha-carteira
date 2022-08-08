<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public function editUser(Request $request)
    {
        $data = $request->all();
        User::findOrFail($request->id)->update($data);
        return redirect('/account')->with("msg", "Salvo com sucesso!");
    }

    public function users()
    {
        $users = User::query()->get();

        return view("users", [
            'users' => $users
        ]);
    }
}
