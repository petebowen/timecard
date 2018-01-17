<?php

namespace App\Listeners;

use App\Events\PayPeriodWasUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Timecard\CalculateUsersTotalHoursCommand;
use App\Timecard\CalculateUsersTotalPayCommand;

class SetUserTotals
{
    /**
     * Handle the event.
     *
     * @param  PayPeriodWasUpdated  $event
     * @return void
     */
    public function handle(PayPeriodWasUpdated $event)
    {
        $user = $event->payPeriod->user;
        $payPeriods = $user->payPeriods;

        $command = new CalculateUsersTotalHoursCommand($payPeriods);
        $user->total_hours = $command->execute();

        $command = new CalculateUsersTotalPayCommand($payPeriods);
        $user->total_pay = $command->execute();
        
        $user->save();
    }
}
