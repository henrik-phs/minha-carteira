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

    public function editProfilePicture(Request $request)
    {
        // var_dump($request);
        // exit;
        $data = $request->all();
        // Image upload
        if ($request->hasFile("image") && $request->file("image")->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path("imgs/users"), $imageName);

            $data["profile_photo_path"] = $imageName;
        }

        if (User::findOrFail($request->id)->update($data))
            return redirect('/account')->with("msg", "Salvo com sucesso! $imageName");
        else
            var_dump($request);
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
