<?php
namespace App\Http\Controllers;


use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class ListController extends BaseController
{
    public function index()
    {
        $list = DB::select('select * from list');
        $info = DB::table('list')->selectRaw('date,count(*)')->groupBy('date')->get();
        $date = [];
        $daily = [];
        $count = [];
        $last = 0;
        foreach ($info as $value) {
            foreach ($value as $k => $v) {
                if ($k == "date") {
                    $date[] = "'".$v."'";
                } else {
                    $last += $v;
                    $daily[] = $v;
                    $count[] = $last;
                }
            }
        }
        $date = "[".implode(',',$date)."]";
        $count = "[".implode(',',$count)."]";
        $daily = "[".implode(',',$daily)."]";

        return view('list', ['list' => $list, 'date' => $date, 'daily' => $daily,'count'=>$count,'last' => $last]);
    }
}

