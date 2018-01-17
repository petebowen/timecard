<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\PayPeriod;
use Carbon\Carbon;

use Auth;

class PayPeriodController extends Controller
{
	public function index()
	{
		$payPeriods = PayPeriod::where('user_id', Auth::id())->orderBy('start','desc')->take(52)->get();

		return view('user.pay_period.index',[
			'user' 			=> Auth::user(),
			'payPeriods'	=> $payPeriods	
		]);
	}

	public function edit(App\Models\PayPeriod $payPeriod)
	{
		return view('user.pay_period.edit',['payPeriod' => $payPeriod]);
	}
}