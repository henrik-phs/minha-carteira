<?php

namespace App\Http\Controllers;

use App\Models\Insert;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view("welcome");
    }

    public function insert()
    {
        return view("insert");
    }

    public function insertData(Request $request)
    {
        $insert = new Insert();
        $insert->value = $request->value;
        $insert->description = $request->description;
        $insert->type = $request->type;
        $insert->category = $request->category;
        $insert->type_payment = $request->type_payment;
        $insert->date = $request->date;

        $insert->save();

        return redirect('/')->with('msg', 'Sucesso ao inserir!');
    }

    public function read()
    {
        $inserts = Insert::all();

        return view('read', [
            'inserts' => $inserts
        ]);
    }
}
