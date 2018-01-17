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
        $normalHours = 40;
        $overtimeHours = 10;
        $normalRate = 10;
        $overtimeRate = 20;

    	$command = new CalculateGrossPayCommand($normalHours, $overtimeHours, $normalRate, $overtimeRate);

        //40 hours normal time x 10 normal rate = 400
        //plus
        //10 hours overtime x 20 overtime rate = 200
       
        $this->assertEquals(600, $command->execute());
    }

    /** @test **/
    public function gross_pay_calculated_correctly_without_overtime()
    {
        $normalHours = 40;
        $overtimeHours = 0;
        $normalRate = 10;
        $overtimeRate = 20;

        $command = new CalculateGrossPayCommand($normalHours, $overtimeHours, $normalRate, $overtimeRate);

        $this->assertEquals(400, $command->execute());
    }
}
