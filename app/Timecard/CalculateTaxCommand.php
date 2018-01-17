<?php

namespace App\Timecard;

class CalculateTaxCommand
{
	protected $grossPay;

	public function __construct($grossPay)
	{
		$this->grossPay = $grossPay;
	}

	public function execute()
	{
		return $this->grossPay * 0.15;
	}
}