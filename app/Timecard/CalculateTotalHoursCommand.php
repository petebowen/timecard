<?php

namespace App\Timecard;

use Carbon\Carbon;

class CalculateTotalHoursCommand
{
	protected $workPeriods;
	protected $totalHours = 0;

	public function __construct($workPeriods)
	{
		$this->workPeriods = $workPeriods;
	}

	public function execute()
	{
		
		$this->workPeriods->each(function($workPeriod){

			$start = $workPeriod->work_date->addHours(substr($workPeriod->start, 0, 2));

			$start->addMinutes(substr($workPeriod->start, 3,2));
		
			$end = $workPeriod->work_date->addHours(substr($workPeriod->end, 0, 2));
			$end->addMinutes(substr($workPeriod->end, 3,2));
		
			$this->totalHours += ($start->diffInMinutes($end) / 60);//to get it into a decimal

		});

		return $this->totalHours;
	}
}