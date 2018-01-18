<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\PayPeriod;
use Carbon\Carbon;

class PayPeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(function($user){

        	//create a bunch of historical PayPeriods
            //doing it like this to trigger creating work periods
            for ($i=1; $i < 11; $i++) { 
                
                $payPeriod = new PayPeriod();
                $payPeriod->user_id = $user->id;
                $payPeriod->start = Carbon::now()->subWeeks($i)->startOfWeek();
                $payPeriod->end = Carbon::now()->subWeeks($i)->endOfWeek();
                $payPeriod->normal_rate = $user->normal_rate;
                $payPeriod->overtime_rate = $user->overtime_rate;
                $payPeriod->save();
            
            }
        });
            
    }
}
