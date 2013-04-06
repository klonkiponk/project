<?php
class GLB {	
	public static $firstMonth;
	public static $lastMonth;
	public static $firstDay;
	public static $lastDay; 
	public static $days;
	public static $plainFirstDay;
	public static $plainLastDay;
	public static $workDayCountFirstMonth;
	public static $workDayCountLastMonth;
	
	
	//function returns string with one Month added to String in this pattern: YYYY-MM-DD
	public static function addOneMonth()
	{
		$exploded = explode("-",GLB::$firstMonth);
		if($exploded[1]!=12){
			$exploded[1]++;
		} else {
			$exploded[1] = 01;
			$exploded[0]++;
		}
		return implode("-",$exploded);
	}
	
	//returns duration as a integer for time inputs as TIMESTAMP
	public static function calculateDuration($endDate,$startDate)
	{
		$duration = 0;
		for($i = $startDate;$i < $endDate; $i = $i+86400)
		{
			if ((date("N",$i) == 6) OR (date("N",$i) == 7)){
			} else {
				$duration++;
			}
		}
		return $duration;
	}
	
	public static function setToMondayIfWeekDay($day)
	{
		if(date("N",$day) == 7){
			$day = $day+86400;
		} elseif(date("N",$day) == 6){
			$day = $day+172800;
		}
		return $day;
	}
	
	public static function setToFridayIfWeekDay($day)
	{
		if(date("N",$day) == 7){
			$day = $day-172800;
		} elseif(date("N",$day) == 6){
			$day = $day-86400;
		}
		return $day;
	}
	
	
	public static function generateEmptyTDs($endDate,$startDate){
		$return = "";
		for($i = $startDate;$i < $endDate; $i = $i+86400)
		{
			if ((date("N",$i) == 6) OR (date("N",$i) == 7)){
			} else {
				
				
				$today = "";
				if (date("d-m-Y") == date("d-m-Y",$i))
				{
					$today = "today";
				}
				
				//DEBUG$return .= date("d.m.Y",$i)."<br>";
				$return .= '<td class="emptyTD '.$today.' day'.date("d",$i).'" id="'.date("Y-m-d",$i).'"></td>'."\n";
			}
		}
		return $return;
	}
	
	
	
	public static function generateEmptyTDsWithLast($endDate,$startDate){
		$return = "";
		$lastTD = $endDate-86400; 
		for($i = $startDate;$i < $endDate; $i = $i+86400)
		{
			if ((date("N",$i) == 6) OR (date("N",$i) == 7)){
			} elseif ($i == $lastTD) {
				//DEBUG$return .= date("d.m.Y",$i)."<br>";
				$return .= '<td class="emptyTD last Dday'.date("d",$i).'" id="'.date("Y-m-d",$i).'"></td>'."\n";
			} else {
				$return .= '<td class="emptyTD day'.date("d",$i).'" id="'.date("Y-m-d",$i).'"></td>'."\n";				
			}
		}
		return $return;
	}
	
	
	
	
	public static function generatePrimaryTask($endDate,$startDate,$name,$description=""){
		$return = "";
		//HERE <= because we also need the Last Day
		$duration = 0;
		for($i = $startDate;$i <= $endDate; $i = $i+86400)
		{
			if ((date("N",$i) == 6) OR (date("N",$i) == 7)){
			} else {
				$duration++;
				//$return .= "TaskDay: ".date("d.m.Y",$i)."<br>";
			}
		}
		$return .= '<td colspan="'.$duration.'" class="'.$name.' projectMainDates"><div class="primaryTaskRelativeDiv"><div class="primaryTaskName">'.$name.'</div><div class="primaryTaskDetails">'.$description.'</div></div></td>'."\n";				
		return $return;
	}
	
	
	
		public static function generateHoliday($endDate,$startDate,$name){
		$return = "";
		//HERE <= because we also need the Last Day
		$duration = 0;
		for($i = $startDate;$i <= $endDate; $i = $i+86400)
		{
			if ((date("N",$i) == 6) OR (date("N",$i) == 7)){
			} else {
				$duration++;
				//$return .= "TaskDay: ".date("d.m.Y",$i)."<br>";
			}
		}
		$return .= '<td colspan="'.$duration.'" class="holiday">Urlaub</td>'."\n";				
		return $return;
	}
	public static function generateTask($endDate,$startDate,$task,$trid,$username){
		$return = "";
		//HERE <= because we also need the Last Day
		$duration = 0;
		for($i = $startDate;$i <= $endDate; $i = $i+86400)
		{
			if ((date("N",$i) == 6) OR (date("N",$i) == 7)){
			} else {
				$duration++;
				//DEBUG $return .= "TaskDay: ".date("d.m.Y",$i)."<br>";
			}
		}
		//DEBUG $return .= "DURATION: ".$duration;
		$return .= "<td class='singleTask ".$username."' colspan='".$duration."'>";
		if($duration == 1){
		}else{
			$return .= "			
				<span style='background:".$trid."' class='".$trid." taetigkeitsbox'>
				</span>";
		}
		$return .= "<span class='".$trid['name']."'>".$username."</span></td>\n";
		return $return;
	}
	public static function generatePersonTask($endDate,$startDate,$task,$projectName,$projectColor,$tridColor,$tridName){
		$return = "";
		//HERE <= because we also need the Last Day
		$duration = 0;
		for($i = $startDate;$i <= $endDate; $i = $i+86400)
		{
			if ((date("N",$i) == 6) OR (date("N",$i) == 7)){
			} else {
				$duration++;
				//DEBUG $return .= "TaskDay: ".date("d.m.Y",$i)."<br>";
			}
		}
		//DEBUG $return .= "DURATION: ".$duration;
		$return .= "<td class='singleTask ".$projectColor."' colspan='".$duration."'>";
		if($duration < 5){
			$return .= "<span style='background:".$tridColor."' class='".$tridName." taetigkeitsbox'>
				</span>";
		}else{
			$return .= "			
				<span style='background:".$tridColor."' class='".$tridName." taetigkeitsbox'>
				</span>".$projectName;
		}
		$return .= "</td>\n";
		return $return;
	}
	public static function generateNextNavigation()
	{
		$month = $_POST['month'];
		$year = $_POST['year'];
		if($month==12){
			$month = 01;
			$year++;
		} else {
			$month++;
		}
		$return = '<form action="" class="next" method="post">
		
				<button type="submit" class="icon-chevron-right" value="next"></button>
				<input type="hidden" name="year" value="'.$year.'">
				<input type="hidden" name="month" value="'.$month.'">
				</form>';
		return $return;
	}
	public static function generatePreviousNavigation()
	{
		$month = $_POST['month'];
		$year = $_POST['year'];
		if($month==01){
			$month = 12;
			$year--;
		} else {
			$month--;
		}
		$return = '<form action="" method="post" class="previous">
		
				<button type="submit" class="icon-chevron-left" value="previous"></button>
				<input type="hidden" name="year" value="'.$year.'">
				<input type="hidden" name="month" value="'.$month.'">
				</form>';
		return $return;
	}
	
	
	public static function getNameFromTaskRoles($trid)
	{
		$sql = "SELECT name,color FROM taskroles WHERE trid=".$trid;
		$result = $GLOBALS['DB']->query($sql);
		$result = $result->fetch_array();
		return $result;
	}
}
?>