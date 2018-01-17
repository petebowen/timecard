<?php

namespace App\Timecard;

class CalculateUsersTotalHoursCommand
{
	protected $payPeriods;

	public function __construct($payPeriods)
	{
		$this->payPeriods = $payPeriods;
	}

	public function execute()
	{
		return $this->payPeriods->sum('normal_hours') + $this->payPeriods->sum('overtime_hours');
	}
}
