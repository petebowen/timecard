<?php

namespace App\Timecard;

use Carbon\Carbon;

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

			$start = $workPeriod->work_date->addHours(substr($workPeriod->start, 0, 2));

			$start->addMinutes(substr($workPeriod->start, 3,2));
		
			$end = $workPeriod->work_date->addHours(substr($workPeriod->end, 0, 2));
			$end->addMinutes(substr($workPeriod->end, 3,2));
		
			$totalHours += ($start->diffInMinutes($end) / 60);//to get it into a decimal

		});

		return $totalHours;
	}
}