<?php
/*
*
@return $this->firstDay
@return	$this->lastDay
@return $this->firstMonth
@return $this->lastMonth
@return $this->dayRangeCount
@return $this->days //<th> Columns
*/

class dateTimeOperations
{	
	public $dayRangeCount = "";
	public function __construct($firstMonth,$lastMonth) {
		GLB::$firstMonth = $firstMonth;
		GLB::$lastMonth  = $lastMonth;
		GLB::$firstDay = $this->setFirstDay();
		GLB::$lastDay  = $this->setLastDay();
		GLB::$days = $this->generateDaysForMonth(GLB::$firstMonth);
		GLB::$days .= $this->generateDaysForMonth(GLB::$lastMonth);
		return $this;
	}
	
	/*INSERT A SINGLE DAY... FUNCTION GENERATES FOR THIS MONTH A WHOLE OVERVIEW*/
	public function generateDaysForMonth($date,$dayRangeCount = "")
	{
		
		$month = strtotime($date);

		//echo "<strong>".date("F",$month)."</strong> hat ".date("t",$month)." Tage<br>";
		$month = date("t",$month);
		
		$dayRangeCount .= $month;
	
		$days = "";
		for ($i = 1; $i <= $month; $i++)
			{
			$currentDay = date("d",mktime(0,0,0,date("n",$month),$i,date("Y",$month)));
			$days .= '<th class="calendarDay day'.$currentDay.'">';
			$days .= $currentDay;
			$days .= '</th>';
			$weekend = array("6","7");
			
			/*if (in_array(date("N",mktime(0,0,0,date("n",$month),$i,date("Y",$month))),$weekend))
			{
				$days .= "Weekend";
			}
			$days .= "<br>";*/
		}
		$days;
		return $days;
	}
	
	private function setFirstDay()
	{
		$firstMonth = strtotime(GLB::$firstMonth);
		$firstDay = mktime(0,0,0,date("n",$firstMonth),01,date("Y",$firstMonth));

		//DEBUG
		//echo '<br>$firstDay: '.date("d.m.Y",$firstDay)."<br>";
		//DEBUG
		return $firstDay;
	}
	private function setLastDay()
	{
		$lastMonth = strtotime(GLB::$lastMonth);
		$lastDay = mktime(0,0,0,date("n",$lastMonth),date("t",$lastMonth),date("Y",$lastMonth));

		//DEBUG
		//echo $lastDay."</br>";
		//echo '<br>$lastDay: '.date("d.m.Y",$lastDay)."<br>";		
		//DEBUG
		return $lastDay;
	}	
}
?>