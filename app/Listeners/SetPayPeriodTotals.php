<?php

namespace App\Listeners;

use App\Events\WorkPeriodWasUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Timecard\CalculateNormalHoursCommand;
use App\Timecard\CalculateOvertimeHoursCommand;
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

        $totalHours = $payPeriod->workPeriods->sum('HoursWorked');

        $command = new CalculateNormalHoursCommand($totalHours, $payPeriod->user->contracted_hours);
        $payPeriod->normal_hours = $command->execute();
        
        
        $command = new CalculateOvertimeHoursCommand($totalHours, $payPeriod->user->contracted_hours);
        $payPeriod->overtime_hours = $command->execute();
        

        $command = new CalculateGrossPayCommand(
            $payPeriod->normal_hours,
            $payPeriod->overtime_hours,
            $payPeriod->user->normal_rate,
            $payPeriod->user->overtime_rate
        );
        $payPeriod->gross = $command->execute();


        $command = new CalculateTaxCommand($payPeriod->gross);
        $payPeriod->tax = $command->execute();


        $command = new CalculateNationalInsuranceCommand($payPeriod->gross);
        $payPeriod->national_insurance = $command->execute();


        $command = new CalculateNetPayCommand(
            $payPeriod->gross,
            [
                $payPeriod->tax,
                $payPeriod->national_insurance
            ]);
        $payPeriod->net = $command->execute();

        $payPeriod->save();
    }
}
