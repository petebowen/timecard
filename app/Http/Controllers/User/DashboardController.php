<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PayPeriod;
use App\Models\WorkPeriod;
use Carbon\Carbon;

use Auth;

class DashboardController extends Controller
{
    public function index()
    {

    	//get the current pay period or create a new one
    	//@todo: tidy this up to use firstOrCreate
		if(!$payPeriod = PayPeriod::where('user_id', Auth::id())->current()->first()){
			
			$payPeriod = new PayPeriod();
            $payPeriod->start = Carbon::now()->startOfWeek();
            $payPeriod->end = Carbon::now()->endOfWeek();
			$payPeriod->user_id = Auth::user()->id;
            $payPeriod->normal_rate = Auth::user()->normal_rate;
            $payPeriod->overtime_rate = Auth::user()->overtime_rate;
			$payPeriod->save();
		}

        //get today's work period
        $workPeriod = WorkPeriod::where('pay_period_id', $payPeriod->id)->where('work_date',Carbon::now()->toDateString() .' 00:00:00')->first();//@todo: fix this clunky workaround or move this to a scope in the model
        
        return view('user.dashboard.index', [
        	'user' 		       => Auth::user(),
        	'payPeriod'        => $payPeriod,
        	'todaysWorkPeriod' => $workPeriod,
        ]);
    }
}
