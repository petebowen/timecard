<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Timecard\CalculateNetPayCommand;

class CalculateNetPayTest extends TestCase
{
    /** @test **/
    public function net_pay_calculated_correctly()
    {
    	$gross = 1000;
    	$deductions = [100,50,50];
    	$command = new CalculateNetPayCommand($gross, $deductions);
    	//1000 - 100 - 50 - 50 = 800
        $this->assertEquals(800, $command->execute());
    }
}
