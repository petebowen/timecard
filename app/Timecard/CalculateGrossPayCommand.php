<?php

namespace App\Timecard;

class CalculateGrossPayCommand
{
	protected $totalHours;
	protected $contractedHours;
	protected $normalRate;
	protected $overtimeRate;

	public function __construct($totalHours, $contractedHours, $normalRate, $overtimeRate)
	{
		$this->totalHours = $totalHours;
		$this->contractedHours = $contractedHours;
		$this->normalRate = $normalRate;
		$this->overtimeRate = $overtimeRate;
	}

	public function execute()
	{

		$overtimeHours = $this->totalHours - $this->contractedHours;
		if($overtimeHours < 0){
			$overtimeHours = 0;
		}

		$normalHours = $this->totalHours - $overtimeHours;

		return round(($normalHours * $this->normalRate) + ($overtimeHours * $this->overtimeRate),2);
	}

}