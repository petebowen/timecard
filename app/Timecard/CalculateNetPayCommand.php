<?php

namespace App\Timecard;

class CalculateNetPayCommand
{
	protected $gross;
	protected $deductions;

	public function __construct($gross, $deductions = [])
	{
		$this->gross = $gross;
		$this->deductions = $deductions;
	}

	public function execute()
	{
		return ($this->gross - array_sum($this->deductions));
	}
}