<?php

namespace App\Listeners;

use App\Events\PayPeriodWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\WorkPeriod;
use Carbon\Carbon;

class CreateWorkPeriods
{

    /**
     * Create a work period for each day in the pay period
     *
     * @param  PayPeriodWasCreated  $event
     * @return void
     */
    public function handle(PayPeriodWasCreated $event)
    {
        for ($i=0; $i < 7; $i++) { 
            
            $workPeriod = new WorkPeriod;
            $workPeriod->pay_period_id = $event->payPeriod->id;
            $workPeriod->work_date = $event->payPeriod->start->addDays($i);

            $workPeriod->save();
        }
    }
}
