<?php

namespace App\Listeners;

use App\Events\WorkPeriodWasUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Timecard\CalculateTotalHoursCommand;
use App\Timecard\CalculateGrossPayCommand;
use App\Timecard\CalculateTaxCommand;
use App\Timecard\CalculateNationalInsuranceCommand;
use App\Timecard\CalculateNetPayCommand;

class SetPayPeriodTotals
{

    /**
     * Handle the event.
     *
     * @param  WorkPeriodWasUpdated  $event
     * @return void
     */
    public function handle(WorkPeriodWasUpdated $event)
    {
        $payPeriod = $event->workPeriod->payPeriod;


        //calculate gross pay
        $command = new CalculateTotalHoursCommand($payPeriod->workPeriods);
        $totalHours = $command->execute();

        $contractedHours = $payPeriod->user->contracted_hours;
        $normalRate = $payPeriod->user->normal_rate;
        $overtimeRate = $payPeriod->user->overtime_rate;
        
        $command = new CalculateGrossPayCommand($totalHours, $contractedHours, $normalRate, $overtimeRate);
        
        $payPeriod->gross = $command->execute();



        $command = new CalculateTaxCommand($payPeriod->gross);
        $payPeriod->tax = $command->execute();

        $command = new CalculateNationalInsuranceCommand($payPeriod->gross);
        $payPeriod->national_insurance = $command->execute();

        $command = new CalculateNetPayCommand($payPeriod->gross,[$payPeriod->tax, $payPeriod->national_insurance]);
        $payPeriod->net = $command->execute();

        $payPeriod->save();

    }
}
