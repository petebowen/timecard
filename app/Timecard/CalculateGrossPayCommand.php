<?php

namespace App\Timecard;

class CalculateGrossPayCommand
{
	protected $normalHours;
	protected $overtimeHours;
	protected $normalRate;
	protected $overtimeRate;

	public function __construct($normalHours, $overtimeHours, $normalRate, $overtimeRate)
	{
		$this->normalHours = $normalHours;
		$this->overtimeHours = $overtimeHours;
		$this->normalRate = $normalRate;
		$this->overtimeRate = $overtimeRate;
	}

	public function execute()
	{
		return round(($this->normalHours * $this->normalRate) + ($this->overtimeHours * $this->overtimeRate),2);
	}

}