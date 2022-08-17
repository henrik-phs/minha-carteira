<?php

namespace App\Http\Controllers;

use App\Models\Insert;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function filters()
    {
        $start = request("start");
        $end = request("end");
        $description = request("description");
        $category = request("category");
        $type_payment = request("type_payment");
        $type = request("type");
        $data = array();

        if($start || $end){
            $start = $start ? $start : date("Y-m-d", strtotime("-7 days", strtotime(date("Y-m-d"))));
            $end = $end ? $end : date("Y-m-d");

            $data[] = "date BETWEEN '$start' AND '$end'";
        }

        if ($description)
            $data[] = "description LIKE '%$description%'";

        if ($category)
            $data[] = "category = '$category'";

        if ($type_payment)
            $data[] = "payment_type = '$type_payment'";

        if ($type || $type == '0')
            $data[] = "type = '$type'";

        return implode(" AND ", $data);
    }

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

        $filters = $this->filters();

        if ($filters) {
            $inserts = Insert::whereRaw($filters)->where("user_id", $user->id)->orderBy('date', 'DESC')->paginate();
        } else {
            $inserts = Insert::where("user_id", $user->id)->orderBy('date', 'DESC')->paginate();
        }

        $categories = Insert::select("category")->groupBy("category")->get();

        return view('read', [
            'inserts' => $inserts,
            'categories' => $categories
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
        $filters = $this->filters();

        if ($filters) {
            $filters = $filters . " AND ";
        } 

        $categories = Insert::select("category")->groupBy("category")->get();

        $total_pay_in  = Insert::whereRaw($filters . "type = 1 AND user_id = $user->id")->sum('value');
        $total_pay_out = Insert::whereRaw($filters . "type = 0 AND user_id = $user->id")->sum('value');

        $total_day_in  = Insert::whereRaw($filters . "type = 1 AND user_id = $user->id")->whereRaw("value = (SELECT MAX(value) FROM inserts)")->first();
        if (!$total_day_in)
            $total_day_in  = Insert::whereRaw($filters . "type = 1 AND user_id = $user->id")->first();

        $total_day_out = Insert::whereRaw($filters . "type = 0 AND user_id = $user->id")->whereRaw("value = (SELECT MAX(value) FROM inserts)")->first();
        if (!$total_day_out)
            $total_day_out  = Insert::whereRaw($filters . "type = 0 AND user_id = $user->id")->first();

        $total_history_in = Insert::select("date")->selectRaw("SUM(value) as value")->whereRaw($filters . "type = 1 AND user_id = $user->id")->groupBy("date")->get();
        $total_history_out = Insert::select("date")->selectRaw("SUM(value) as value")->whereRaw($filters . "type = 0 AND user_id = $user->id")->groupBy("date")->get();

        $pay_in_cash = Insert::selectRaw("SUM(value) as value")->where("type_payment", "dinheiro")->whereRaw($filters . "type = 1 AND user_id = $user->id")->first();
        $pay_in_card = Insert::selectRaw("SUM(value) as value")->where("type_payment", "cartão de crédito")->whereRaw($filters . "type = 1 AND user_id = $user->id")->first();
        $pay_in_pix = Insert::selectRaw("SUM(value) as value")->where("type_payment", "pix")->whereRaw($filters . "type = 1 AND user_id = $user->id")->first();

        $pay_out_cash = Insert::selectRaw("SUM(value) as value")->where("type_payment", "dinheiro")->whereRaw($filters . "type = 0 AND user_id = $user->id")->first();
        $pay_out_card = Insert::selectRaw("SUM(value) as value")->where("type_payment", "cartão de crédito")->whereRaw($filters . "type = 0 AND user_id = $user->id")->first();
        $pay_out_pix = Insert::selectRaw("SUM(value) as value")->where("type_payment", "pix")->whereRaw($filters . "type = 0 AND user_id = $user->id")->first();

        return view('report', [
            "categories"        => $categories,
            "total_pay_in"      => $total_pay_in,
            "total_pay_out"     => $total_pay_out,
            "total_day_in"      => $total_day_in,
            "total_day_out"     => $total_day_out,
            "total_history_in"  => $total_history_in,
            "total_history_out" => $total_history_out,
            "pay_in_cash"       => $pay_in_cash->value,
            "pay_in_card"       => $pay_in_card->value,
            "pay_in_pix"        => $pay_in_pix->value,
            "pay_out_cash"      => $pay_out_cash->value,
            "pay_out_card"      => $pay_out_card->value,
            "pay_out_pix"       => $pay_out_pix->value,
        ]);
    }
}
