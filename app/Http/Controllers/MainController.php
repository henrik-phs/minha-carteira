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

    public function dashboard()
    {
        return view("dashboard");
    }

    public function insert()
    {
        return view("insert");
    }

    public function insertData(Request $request)
    {
        $user = auth()->user();

        $insert = new Insert();
        $insert->value = $request->value;
        $insert->description = $request->description;
        $insert->type = $request->type;
        $insert->category = $request->category;
        $insert->type_payment = $request->type_payment;
        $insert->date = $request->date;
        $insert->user_id = $user->id;

        $insert->save();

        return redirect('/dashboard')->with('msg', 'Sucesso ao inserir!');
    }

    public function read()
    {
        $user = auth()->user();
        $inserts = Insert::where("user_id", $user->id)->orderBy('date', 'DESC')->get();

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
        $user = auth()->user();

        $total_pay_in  = Insert::where("type", "1")->where("user_id", $user->id)->sum('value');
        $total_pay_out = Insert::where("type", "0")->where("user_id", $user->id)->sum('value');

        $total_day_in  = Insert::where("type", "1")->where("user_id", $user->id)->whereRaw("value = (SELECT MAX(value) FROM inserts)")->first();
        if (!$total_day_in)
            $total_day_in  = Insert::where("type", "1")->where("user_id", $user->id)->first();

        $total_day_out = Insert::where("type", "0")->where("user_id", $user->id)->whereRaw("value = (SELECT MAX(value) FROM inserts)")->first();
        if (!$total_day_out)
            $total_day_out  = Insert::where("type", "0")->where("user_id", $user->id)->first();

        $total_history_in = Insert::select("date")->selectRaw("SUM(value) as value")->where("type", "1")->where("user_id", $user->id)->groupBy("date")->get();
        $total_history_out = Insert::select("date")->selectRaw("SUM(value) as value")->where("type", "0")->where("user_id", $user->id)->groupBy("date")->get();
        
        $pay_in_cash = Insert::selectRaw("SUM(value) as value")->where("type", "1")->where("type_payment", "dinheiro")->where("user_id", $user->id)->first();
        $pay_in_card = Insert::selectRaw("SUM(value) as value")->where("type", "1")->where("type_payment", "cartão de crédito")->where("user_id", $user->id)->first();
        $pay_in_pix = Insert::selectRaw("SUM(value) as value")->where("type", "1")->where("type_payment", "pix")->where("user_id", $user->id)->first();

        $pay_out_cash = Insert::selectRaw("SUM(value) as value")->where("type", "0")->where("type_payment", "dinheiro")->where("user_id", $user->id)->first();
        $pay_out_card = Insert::selectRaw("SUM(value) as value")->where("type", "0")->where("type_payment", "cartão de crédito")->where("user_id", $user->id)->first();
        $pay_out_pix = Insert::selectRaw("SUM(value) as value")->where("type", "0")->where("type_payment", "pix")->where("user_id", $user->id)->first();

        return view('report', [
            "total_pay_in"      => $total_pay_in,
            "total_pay_out"     => $total_pay_out,
            "total_day_in"      => $total_day_in,
            "total_day_out"     => $total_day_out,
            "total_history_in"  => $total_history_in,
            "total_history_out" => $total_history_out,
            "pay_in_cash" => $pay_in_cash->value,
            "pay_in_card" => $pay_in_card->value,
            "pay_in_pix" => $pay_in_pix->value,
            "pay_out_cash" => $pay_out_cash->value,
            "pay_out_card" => $pay_out_card->value,
            "pay_out_pix" => $pay_out_pix->value,
        ]);
    }
}
