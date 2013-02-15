<?php
class dateTimeOperations
{	
	public $dayRangeCount = "";
	public $firstWeek = "";
	public function __construct($firstMonth,$lastMonth) {
		GLB::$firstMonth = $firstMonth;
		GLB::$lastMonth  = $lastMonth;
		GLB::$plainFirstDay = $this->setPlainFirstDay();
		GLB::$plainLastDay = $this->setPlainLastDay();
		
		//Stripes Off beginning or Ending Weekend Days
		GLB::$firstDay = $this->setFirstDay();
		GLB::$lastDay  = $this->setLastDay();
		GLB::$days = $this->generateDaysForBothMonth();
		return $this;
	}
	private function setFirstDay()
	{
		$firstMonth = strtotime(GLB::$firstMonth);
		$firstDay = mktime(0,0,0,date("n",$firstMonth),01,date("Y",$firstMonth));
		$firstDay = GLB::setToMondayIfWeekDay($firstDay);
		//DEBUG
		//echo '<br>$firstDay: '.date("d.m.Y",$firstDay)."<br>";
		//DEBUG
		return $firstDay;
	}
	private function setPlainFirstDay()
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
		$lastDay = GLB::setToFridayIfWeekDay($lastDay);
		//DEBUG
		//echo $lastDay."</br>";
		//echo '<br>$lastDay: '.date("d.m.Y",$lastDay)."<br>";		
		//DEBUG
		return $lastDay;
	}
	private function setPlainLastDay()
	{
		$lastMonth = strtotime(GLB::$lastMonth);
		$lastDay = mktime(0,0,0,date("n",$lastMonth),date("t",$lastMonth),date("Y",$lastMonth));
		//DEBUG
		//echo $lastDay."</br>";
		//echo '<br>$lastDay: '.date("d.m.Y",$lastDay)."<br>";		
		//DEBUG
		return $lastDay;
	}
	
	
	//Prints out the TH for a CalendarWeek
	//Cuts it to the Integer itself, if the colspan is to less and would make a 2 row TH
	private function calendarMonth()
	{
		$calendarWeek = '<th class="calendarMonth" colspan="'.GLB::$workDayCountFirstMonth.'">'.date("M",GLB::$firstDay).'</th>';
		$calendarWeek .= '<th class="calendarMonth" colspan="'.GLB::$workDayCountLastMonth.'">'.date("M",GLB::$lastDay).'</th>';
		return $calendarWeek;
	}
	
	
	//Prints out the TH for a CalendarWeek
	//Cuts it to the Integer itself, if the colspan is to less and would make a 2 row TH
	private function calendarWeek($length,$week)
	{
		if ($length <3){
			$calendarWeek = '<th class="calendarWeek" colspan="'.$length.'">'.$week.'</th>';
		} else {
			$calendarWeek = '<th class="calendarWeek" colspan="'.$length.'">KW '.$week.'</th>';
		}
		return $calendarWeek;
	}
	
	private function generateDaysForBothMonth(){
		$return = "";
		$dayRangeCount = date("t",GLB::$plainFirstDay) + date("t",GLB::$plainLastDay);
		//$dayRangeCount = GLB::calculateDuration(GLB::$lastDay,GLB::$firstDay);
		$day = GLB::$plainFirstDay;
		$KW = date("W",GLB::$firstDay); //use the stripped FirstDay here, otherwise th calendarWeek might be set to the of te striped week
		$KWCount = 0;
		$KWreturn = "";
		$KWs = "";
		$MONAT = date("m",$day);
		$monatsTageCount = 0;
		$firstMonthDayCount = 0;
		$DAYs = "";
		for ($i = 0;$i <= $dayRangeCount;$i++){		
			//WEEKEND DAY CHECK
			//reduces the total Amount of Day by 1 if its a Saturday or Sunday
			if ((date("N",$day)== 6) OR (date("N",$day)== 7)){

				//Do Nothing for WeekendDays
				
				//Do Outprint the calendarWeek if the Last is a Saturday or Sunday
				//Do ALSO Outprint the calendarMonth				

				if($i == $dayRangeCount){
					$KWs .= $this->calendarWeek($KWCount,$KW);
				}
			} else {
				//If its a normal WeekDay
				/***********************\
				Month Operations
				\***********************/

				//If its a normal WeekDay
				if($i == $dayRangeCount){
					$KWs .= $this->calendarWeek($KWCount,$KW);
				} else {
					$FORKW = date("W",$day);
					if ($FORKW == $KW) {
						$KWCount++;
					} else {
						//echo "KW ".$KW."hat ".$KWCount." Tage";
						$KWs .= $this->calendarWeek($KWCount,$KW);
						$KW = $FORKW;
						$KWCount = 1;
					}
					if(date("m",$day) == $MONAT){
						$firstMonthDayCount++;
					}
					$DAYs .= '<th class="calendarDay day'.date("d",$day).'">';
					$DAYs .= date("d",$day);
					$DAYs .= '</th>';
					$monatsTageCount++;
				}
			}//END of Weekend Check
			$day = $day+86400;
		}
		//$monatsTageCount=$monatsTageCount-1;
		GLB::$workDayCountFirstMonth = $firstMonthDayCount;
		GLB::$workDayCountLastMonth = $monatsTageCount-$firstMonthDayCount;
		
		$return .= '<tr><th></th>';
		$return .= $this->calendarMonth();
		$return .= '</tr>';
		$return .= "<tr class='weeks'><th></th>";
		$return .= $KWs;
		$return .= "</tr><tr class='days'><th></th>";
		$return .= $DAYs;
		$return .= "</tr>";
		return $return;
	}
}
?>