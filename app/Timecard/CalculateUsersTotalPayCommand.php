<?php

namespace App\Timecard;

class CalculateUsersTotalPayCommand
{
	protected $payPeriods;

	public function __construct($payPeriods)
	{
		$this->payPeriods = $payPeriods;
	}

	public function execute()
	{
		return $this->payPeriods->sum('gross');
	}
}
