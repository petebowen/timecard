<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Timecard\CalculateUsersTotalPayCommand;

class CalculateUsersTotalPayTest extends TestCase
{
    /** @test **/
    public function total_pay_is_the_sum_of_gross_for_all_pay_periods()
    {
        
    	$payPeriods = factory(\App\Models\PayPeriod::class, 5)->create(['gross'	=> 1000]);

    	$command = new CalculateUsersTotalPayCommand($payPeriods);

    	//5 pay periods * (1000 gross) = 5000

        $this->assertEquals(5000, $command->execute());
    }
}
