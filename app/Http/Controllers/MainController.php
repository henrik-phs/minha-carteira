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
        $inserts = Insert::query()->orderBy('date', 'DESC')->get();

        return view('read', [
            'inserts' => $inserts
        ]);
    }

    public function edit($id)
    {
        $insert = Insert::findOrFail($id);
        return view("edit", [
            'insert' => $insert
        ]);
    }

    public function editData(Request $request)
    {
        $data = $request->all();

        Insert::findOrFail($request->id)->update($data);

        return redirect('/read')->with('msg', 'Atualizado com sucesso');
    }

    public function deleteData($id)
    {
        Insert::findOrFail($id)->delete();

        return redirect('/read')->with('msg', 'Excluído com sucesso');
    }

    public function report()
    {
        $total_in = Insert::where("type", "1")->get();
        return view('report', [
            "total_in" => $total_in
        ]);
    }
}
