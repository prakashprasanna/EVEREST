<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Charts;
use App\employee;
use App\followup;
use App\enquiry;

class ChartController extends Controller
{
    public function index()
    {
    	$users = followup::whereMonth('created_at', '=', date('m'))->get();
        $dis = $users->unique('gef_phone');
        $dis->values()->all();
        $chart = Charts::database($dis, 'bar', 'highcharts')
			      ->title("Monthly Statistics")
			      ->elementLabel("Leads Worked for August")
			      ->dimensions(1000, 500)
			      ->responsive(false)
			      ->groupBy('added_by');
        return view('chart',compact('chart'));

    }
}