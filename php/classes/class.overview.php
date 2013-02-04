<?php
/**
 * overview class.
 */
class overview {	
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @param mixed $pid
	 * @return void
	 */
	public function __construct()
	{		
		//echo date("d.m.Y",$days->firstDay);
		//echo date("d.m.Y",$days->lastDay);
	}
	/**
	 * getTasksfromDB function.
	 * 
	 * @access private
	 * @return string with primaryTask <td>'s
	 */
	public function getAllProjects()
	{
		echo date("M",GLB::$firstDay);
		echo " - ";
		echo date("M",GLB::$lastDay);
		$sql = "SELECT pid,startdate,enddate FROM projects";
		$result = $GLOBALS['DB']->query($sql);
		
		$return = "";
		$return .= $this->generateNextNavigation();
		$return .= $this->generatePreviousNavigation();
		
		$return .= "<hr>";
		$return .= $this->generateTableHead();
		
	    while ($singleProject = $result->fetch_array())
	    {
			if(strtotime($singleProject['startdate']) <= GLB::$lastDay AND strtotime($singleProject['enddate']) >= GLB::$firstDay)
			{			
				$singleProject = new singleProject($singleProject['pid']);
				$return .= $singleProject;
				unset($singleProject);
			}
	    }
		
		$return .= $this->generateTableFoot();
	    return $return;
	}
	private function generateNextNavigation()
	{
		$month = $_POST['month'];
		$year = $_POST['year'];
		if($month==12){
			$month = 01;
			$year++;
		} else {
			$month++;
		}
		$return = '<form action="" class="next" method="post"><input type="submit" value="next">
				<input type="hidden" name="year" value="'.$year.'">
				<input type="hidden" name="month" value="'.$month.'">
				</form>';
		return $return;
	}
	private function generatePreviousNavigation()
	{
		$month = $_POST['month'];
		$year = $_POST['year'];
		if($month==01){
			$month = 12;
			$year--;
		} else {
			$month--;
		}
		$return = '<form action="" method="post" class="previous"><input type="submit" value="previous">
				<input type="hidden" name="year" value="'.$year.'">
				<input type="hidden" name="month" value="'.$month.'">
				</form>';
		return $return;
	}
	private function generateTableHead()
	{
	$return = '<article class="projectCalendar">      	    
			<table>
			
			<thead>
				<tr>
					<th></th>
					<th colspan="7" class="calendarWeek">KW1</th>
					<th colspan="7" class="calendarWeek">KW2</th>
					<th colspan="7" class="calendarWeek">KW3</th>
					<th colspan="7" class="calendarWeek">KW4</th>
					<th colspan="7" class="calendarWeek">KW5</th>
					<th colspan="7" class="calendarWeek">KW6</th>
					<th colspan="7" class="calendarWeek">KW7</th>
					<th colspan="7" class="calendarWeek">KW8</th>
				</tr>
				<tr>
					<th></th>';
	
	
	
	
	$return .= GLB::$days;
	
	
	
	
	
	$return .= '</tr>
			</thead>
			<tbody>';
			return $return;
	}//END OF FUNCTION generateTableHead

	private function generateTableFoot()
	{
		$return ="</tbody></table>";
		return $return;
	}
}
?>