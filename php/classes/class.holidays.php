<?php
class holidays {
	
	public function __construct($wholeDayCount,$uid){
		$this->uid = $uid;
		$this->wholeDayCount = $wholeDayCount;
	}
	
	public function returnHolidays()
	{
//		return "<td class='holydays' colspan='".$this->wholeDayCount."'>HOLYDAYS!!!</td></tr>\n";
		$return = $this->getHolidays();
		return $return;
	}
	
	public function getHolidays()
	{
		$sql = "SELECT startdate,enddate FROM holidays WHERE uid=".$this->uid;
		$holidays = $GLOBALS['DB']->query($sql);
		$return = "";
		$actualDate = GLB::$firstDay;

		while ($holiday = $holidays->fetch_array())
	    {
			//convert the 2013-04-01 Strings to a calculateable Date
			$startDate = strtotime($holiday['startdate']);
			$endDate   = strtotime($holiday['enddate']);
			
			//Set Startdates to Monday and Enddates to Friday
			$startDate = GLB::setToMondayIfWeekDay($startDate);
			$endDate = GLB::setToMondayIfWeekDay($endDate);
			
			if($startDate <= GLB::$lastDay AND $endDate >= GLB::$firstDay)
			{
				//Cut Of The Tasks before the given TimeRange and After the Given TimeRange
				if($startDate < GLB::$firstDay){
					$startDate = GLB::$firstDay;
				}
				if($endDate > GLB::$lastDay){
					$endDate = GLB::$lastDay;
				}
				
				
				if ($startDate !== $actualDate) {
					$return .= GLB::generateEmptyTDs($startDate,$actualDate);
					//now set actualDate to StartDate;
					$actualDate = $startDate;
				}
				
				if ($startDate == $actualDate) {
					/**********
					
					DO OUTPUT THE TASKS
					
					**********/
					//DEBUG echo "<br>END: ".date("d.m.Y",$endDate);
					//DEBUG echo "<br>START: ".date("d.m.Y",$startDate);
					$return .= GLB::generateHoliday($endDate,$startDate,"");
					$actualDate = $endDate+86400;
					$actualDate = GLB::setToMondayIfWeekDay($actualDate);
				}
			}
		}
		/**********
		NOW generate the emptyTDs for the End of The Month*/
		//Here it is Important to get the Last Day also as a Empty Day
		$return .= GLB::generateEmptyTDsWithLast(GLB::$lastDay+86400,$actualDate);
		/***********/
		/******************************
			$return .= '<td colspan="'.$duration.'" class="'.$primaryTask["name"].' projectMainDates"><div class="primaryTaskName">'.		$primaryTask["name"].'</div></td>';				
		******************************/
	    return $return;
	}//end of function
}