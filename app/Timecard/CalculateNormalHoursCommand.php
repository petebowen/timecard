<?php

namespace App\Timecard;

class CalculateNormalHoursCommand
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
			return $this->totalHours;
		}
		return $this->contractedHours;
	}
}