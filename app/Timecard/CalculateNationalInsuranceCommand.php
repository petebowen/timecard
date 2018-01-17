<?php

namespace App\Timecard;

class CalculateNationalInsuranceCommand
{

	public function __construct($grossPay)
	{
		$this->grossPay = $grossPay;
	}

	public function execute()
	{
		return $this->grossPay * 0.12;
	}
}