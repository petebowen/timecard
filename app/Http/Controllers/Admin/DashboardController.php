<?php

namespace App\Http\Controllers\Admin;

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
    	dd('admin dashboard');
    }
}