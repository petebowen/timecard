<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Timecard\CalculateGrossPayCommand;

class CalculateGrossPayTest extends TestCase
{
    /** @test **/
    public function gross_pay_calculated_correctly_with_overtime()
    {
        $totalHours = 50;
        $contractedHours = 40;
        $normalRate = 10;
        $overtimeRate = 20;

    	$command = new CalculateGrossPayCommand($totalHours, $contractedHours, $normalRate, $overtimeRate);

    	//overtime = total 50 - contracted 40 = 10 x overtime rate 20 = 200

    	//normal time = total 50 - overtime 10 = 40 x normal rate 10 = 400

    	//gross pay = 200 +400 = 600

        $this->assertEquals(600, $command->execute());
    }

    /** @test **/
    public function gross_pay_calculated_correctly_without_overtime()
    {
        $totalHours = 30;
        $contractedHours = 40;
        $normalRate = 10;
        $overtimeRate = 20;

    	$command = new CalculateGrossPayCommand($totalHours, $contractedHours, $normalRate, $overtimeRate);

    	//overtime = total 30 - contracted 40 = -10 (therefore 0) x overtime rate 20 = 0

    	//normal time = total 30 - overtime 0 = 30 x normal rate 10 = 300

    	//gross pay = 0 + 300 = 300

        $this->assertEquals(300, $command->execute());
    }
}
