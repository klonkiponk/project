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
		$return = '<div class="overview">';
		//echo date("M",GLB::$firstDay);
		//echo " - ";
		//echo date("M",GLB::$lastDay);
		
		$sql = "SELECT pid,startdate,enddate FROM projects ORDER BY ordering DESC";
		$result = $GLOBALS['DB']->query($sql);
		
		
		$return .= GLB::generateNextNavigation();
		$return .= GLB::generatePreviousNavigation();
		
		$return .= "<hr>";
		$return .= $this->generateTableHead();

		$emptyRowColspan = GLB::$workDayCountFirstMonth+GLB::$workDayCountLastMonth+1;
		$return .= '<tr><td colspan="'.$emptyRowColspan.'" class="emptyRow"></td></tr>';
		
	    while ($singleProject = $result->fetch_array())
	    {
			if(strtotime($singleProject['startdate']) <= GLB::$lastDay AND strtotime($singleProject['enddate']) >= GLB::$firstDay)
			{			
				$singleProject = new singleProject($singleProject['pid']);
				$return .= $singleProject;
				unset($singleProject);
				$return .= '<tr><td colspan="'.$emptyRowColspan.'" class="emptyRow"></td></tr>';
			}
	    }
		
		$return .= $this->generateTableFoot();
	    return $return;
	}
	private function generateTableHead()
	{
	$return = '<article class="projectCalendar">      	    
	<table><thead>';	
	$return .= GLB::$days;
	$return .= '</thead>
	<tbody>';
	return $return;
	}//END OF FUNCTION generateTableHead

	private function generateTableFoot()
	{
		$return ="</tbody></table></div>";
		return $return;
	}
}
?>