<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

use Auth;

class PayPeriodController extends Controller
{
	public function show(\App\Models\PayPeriod $payPeriod)
	{
		return view('admin.pay_period.show',['payPeriod' => $payPeriod]);
	}
}