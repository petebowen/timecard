<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PayPeriod;
use App\Models\WorkPeriod;
use Carbon\Carbon;

use Auth;

class WorkPeriodController extends Controller
{
	public function update(Request $request, WorkPeriod $workPeriod)
	{

		//clock in button was pressed
		if($request->has('clock_in')){
			$request->merge(['start' => Carbon::now()->format('H:i')]); 
		}

		//clock out button was pressed
		if($request->has('clock_out')){
			$request->merge(['end' => Carbon::now()->format('H:i')]); 
		}
		
		$workPeriod->update($request->all());
		
		return redirect()->back();
	}
}