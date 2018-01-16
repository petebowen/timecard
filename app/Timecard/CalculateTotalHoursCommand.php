<?php

namespace App\Timecard;

class CalculateTotalHoursCommand
{
	protected $workPeriods;

	public function __construct($workPeriods)
	{
		$this->workPeriods = $workPeriods;
	}

	public function execute()
	{
		$totalHours = 0;
		$this->workPeriods->each(function($workPeriod){

			

		});

		return $totalHours;
	}
}