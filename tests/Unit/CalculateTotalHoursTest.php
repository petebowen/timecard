<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Timecard\CalculateTotalHoursCommand;

class CalculateTotalHoursTest extends TestCase
{
    /** @test **/
    public function total_hours_is_sum_of_work_period_duration()
    {
        
    	$workPeriods = factory(\App\Models\WorkPeriod::class, 5)->create([
    		'start'	=>	'07:00',
    		'end'	=>	'17:30']);

    	$command = new CalculateTotalHoursCommand($workPeriods);
    	//5 work periods x 10.5 hours = 52.5 hours
        $this->assertEquals(52.5, $command->execute());
    }
}
