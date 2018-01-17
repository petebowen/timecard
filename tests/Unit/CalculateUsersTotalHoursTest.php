<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Timecard\CalculateUsersTotalHoursCommand;

class CalculateUsersTotalHoursTest extends TestCase
{
    /** @test **/
    public function total_hours_is_the_sum_of_normal_and_overtime_hours_for_all_pay_periods()
    {
        
    	$payPeriods = factory(\App\Models\PayPeriod::class, 5)->create([
    		'normal_hours'		=>	40,
    		'overtime_hours'	=> 10]);

    	$command = new CalculateUsersTotalHoursCommand($payPeriods);

    	//5 pay periods * (40 normal hours + 10 overtime hours = 50 hours per period) = 250

        $this->assertEquals(250, $command->execute());
    }
}
