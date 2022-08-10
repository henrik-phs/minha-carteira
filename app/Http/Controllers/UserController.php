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

    public function editProfile(Request $request)
    {
        $data = $request->all();
        User::findOrFail($request->id)->update($data);
        return redirect('/account')->with("msg", "Salvo com sucesso!");
    }

    public function users()
    {
        if (auth()->user()->user_type != 1) {
            return redirect('/dashboard');
        }
        $users = User::query()->get();

        return view("users", [
            'users' => $users
        ]);
    }

    public function editUser(Request $request)
    {
        $data = $request->all();
        if (User::findOrFail($request->id)->update($data))
            return redirect('/users')->with("msg", "Salvo com sucesso!");
        else
            return redirect('/users')->with("msg", "Erro ao salvar!");
    }

    public function deleteUser($id)
    {
        if (User::findOrFail($id)->delete())
            return redirect('/users')->with("msg", "Salvo com sucesso!");
        else
            return redirect('/users')->with("msg", "Erro ao salvar!");
    }
}
