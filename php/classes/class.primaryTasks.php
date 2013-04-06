<?php
/**
 * primaryTasks class.
 */
class primaryTasks {
	public $pid;
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @param mixed $pid
	 * @return void
	 */
	public function __construct($pid)
	{
		$this->pid = $pid;
	}

	/**
	 * getTasksfromDB function.
	 * 
	 * @access private
	 * @return string with primaryTask <td>'s
	 */
	public function createNewPrimaryTaskEditForm()
	{
		$return = "";
		$return .= '<span class="primaryTaskToggler">+</span>';
		$return .= '<form method="post" action="" class="newPrimaryTask hidden">';
		$return .= '<input type="hidden" name="pid" value="'.$this->pid.'">';
		$return .= '<input type="text" class="width200" name="name" value="" placeholder="Name">';
		$return .= '<input type="text" class="date datepicker" id="12345startdate'.$this->pid.'" name="startdate" value="" placeholder="von">';
		$return .= "bis&nbsp;&nbsp;&nbsp;&nbsp;";		
		$return .= '<input type="text" class="date datepicker" id="67890enddate'.$this->pid.'" name="enddate" value="" placeholder="bis">';
		$return .= '<input type="text" class="width200" name="description" placeholder="Beschreibung">';		
		$return .= FORM::submitButton("newPrimaryTask","speichern","save");
		$return .= '</form>';
		return $return;
	}	
	 
	public function getTasksFromDBEditForm()
	{
		$sql = "SELECT name,startdate,enddate,ptid,description FROM primarytasks WHERE pid=".$this->pid." ORDER BY startdate";
		$result = $GLOBALS['DB']->query($sql);
		$return = "";
		while ($primaryTask = $result->fetch_array())
	    {
			$return .= '<form method="post">';
			$startDate = strtotime($primaryTask['startdate']);
			$endDate   = strtotime($primaryTask['enddate']);
			$return .= '<input type="text" class="width200"name="name" value="'.$primaryTask['name'].'">';
			$return .= '<input type="hidden" value="'.$primaryTask['ptid'].'" name="ptid">';
			$return .= FORM::startDateInput(date("Y-m-d",$startDate),"",$primaryTask['ptid']);
			$return .= "bis&nbsp;&nbsp;&nbsp;&nbsp;";
			$return .= FORM::endDateInput(date("Y-m-d",$endDate),"",$primaryTask['ptid']);
			$return .= '<input type="text" class="width200" name="description" value="'.$primaryTask['description'].'">';			
			$return .= FORM::submitButton("primaryTask","speichern","save");
			$return .= FORM::submitButton("primaryTask","löschen","delete");
			$return .= '<input type="hidden" name="pid" value="'.$this->pid.'">';
			$return .= '</form>';
	    }
	    return $return;
	}
	 
	  
	 
	 
	public function getTasksFromDB()
	{
		$sql = "SELECT name,startdate,enddate,description FROM primarytasks WHERE pid=".$this->pid." ORDER BY startdate";
		$result = $GLOBALS['DB']->query($sql);
		$return = "";
		$actualDate = GLB::$firstDay;
	    
		
		
		
		while ($primaryTask = $result->fetch_array())
	    {
			//convert the 2013-04-01 Strings to a calculateable Date
			$startDate = strtotime($primaryTask['startdate']);
			$endDate   = strtotime($primaryTask['enddate']);
			
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
					$return .= GLB::generatePrimaryTask($endDate,$startDate,$primaryTask['name'],$primaryTask['description']);
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
}//end of class
?>