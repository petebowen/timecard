<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PayPeriod;
use App\Models\WorkPeriod;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

use Auth;

class DashboardController extends Controller
{
    public function index()
    {
    	//DB::table('pay_periods')->truncate();
    	//DB::table('work_periods')->truncate();
    
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

        return view('user.dashboard.index', [
        	'user' 		=> Auth::user(),
        	'payPeriod' => $payPeriod,
        	'today'		=> Carbon::now()->format('l')
        ]);
    }
}
