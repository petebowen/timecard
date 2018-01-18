<?php

namespace App\Timecard;

class CalculateOvertimeHoursCommand
{
	protected $totalHours;
	protected $contractedHours;

	public function __construct($totalHours, $contractedHours)
	{
		$this->totalHours = $totalHours;
		$this->contractedHours = $contractedHours;
	}

	public function execute()
	{
		if($this->totalHours < $this->contractedHours){
			return 0;
		}
		
		return $this->totalHours - $this->contractedHours;
	}
}