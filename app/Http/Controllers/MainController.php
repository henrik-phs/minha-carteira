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
        $total_pay_in  = Insert::where("type", "1")->sum('value');
        $total_pay_out = Insert::where("type", "0")->sum('value');

        $total_day_in  = Insert::where("type", "1")->whereRaw("value = (SELECT MAX(value) FROM inserts)")->first();
        if (!$total_day_in)
            $total_day_in  = Insert::where("type", "1")->first();

        $total_day_out = Insert::where("type", "0")->whereRaw("value = (SELECT MAX(value) FROM inserts)")->first();
        if (!$total_day_out)
            $total_day_out  = Insert::where("type", "0")->first();

        return view('report', [
            "total_pay_in"  => $total_pay_in,
            "total_pay_out" => $total_pay_out,
            "total_day_in"  => $total_day_in,
            "total_day_out" => $total_day_out,
        ]);
    }
}
