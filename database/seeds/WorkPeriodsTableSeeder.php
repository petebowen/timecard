<?php

use Illuminate\Database\Seeder;

use App\Models\PayPeriod;
use App\Models\WorkPeriod;
use Carbon\Carbon;

class WorkPeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //doing it this way instead of using factory to trigger total calculations
        WorkPeriod::all()->each(function($workPeriod){

        	$workPeriod->start = '09:00';
            $workPeriod->end = '17:00';
            $workPeriod->save();
        });
            
    }
}
