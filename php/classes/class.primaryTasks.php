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
		
		
		$return .= '<h4>New Primary Task</h4>';
		$return .= '<form method="post" action="">';
		$return .= '<input type="hidden" name="pid" value="'.$this->pid.'">';
		$return .= '<input type="hidden" name="editProject" value="true">';
		$return .= '<label>Name</label>';
		$return .= '<input type="text" name="PTname" value="">';
		$return .= FORM::startDateInput("","PT",$this->pid);
		$return .= FORM::endDateInput("","PT",$this->pid);
		$return .= FORM::submitButton("writePrimaryTaskToDB");
		$return .= '</form>';
		
		
		return $return;
	}	
	 
	public function getTasksFromDBEditForm()
	{
		$sql = "SELECT name,startdate,enddate,ptid FROM primarytasks WHERE pid=".$this->pid." ORDER BY startdate";
		$result = $GLOBALS['DB']->query($sql);
		$return = "";
		$return .= "<h4>Primary Tasks</h4>"; 
		while ($primaryTask = $result->fetch_array())
	    {
			$return .= '<form method="post">';
			
			$startDate = strtotime($primaryTask['startdate']);
			$endDate   = strtotime($primaryTask['enddate']);
			$return .= '<label>Name</label>';
			$return .= '<input type="text" name="PTname" value="'.$primaryTask['name'].'">';
			$return .= '<input type="hidden" value="'.$primaryTask['ptid'].'" name="ptid">';
			$return .= FORM::startDateInput(date("Y-m-d",$startDate),"PT",$this->pid);
			$return .= FORM::endDateInput(date("Y-m-d",$endDate),"PT",$this->pid);
			$return .= '<input type="submit" name="PT" value="delete">';
			$return .= '<input type="submit" name="PT" value="save">';
			$return .= '<input type="hidden" name="pid" value="'.$this->pid.'">';
			$return .= '<input type="hidden" name="editProject" value="true">';
			$return .= '</form>';
	    }
	    return $return;	
	}
	 
	  
	 
	 
	public function getTasksFromDB()
	{
	
		//convert our Days to Strings like they are stored in MYSQL
		//$sqlStartDate = date("Y-m-d",$this->firstDay);
		//$sqlEndDate = date("Y-m-d",$this->lastDay);
		//startdate <= ".$sqlEndDate." AND enddate >= ".$sqlStartDate." AND

		$sql = "SELECT name,startdate,enddate FROM primarytasks WHERE pid=".$this->pid." ORDER BY startdate";
		$result = $GLOBALS['DB']->query($sql);
		
		
		
		$return = "";
		$actualDate = 0;
	    
		while ($primaryTask = $result->fetch_array())
	    {
			
		    $startDate = strtotime($primaryTask['startdate']);
			$endDate   = strtotime($primaryTask['enddate']);
			
			//$startDate <= $this->lastDay AND $endDate >= $this->firstDay
			if($startDate <= GLB::$lastDay AND $endDate >= GLB::$firstDay)
			{
				if ($actualDate==0)
				{
					if (date("z",$endDate) !== date("z",GLB::$firstDay))
					{
						$duration = $this->calculateDuration($startDate,GLB::$firstDay);
					
						for($i = 1; $i <= $duration;$i++){
							$return .= '<td class="emptyTD"></td>';
						}
						//$return .= '<td class="" colspan="'.$duration.'"></td>';
					}
				}
				
				if($actualDate!=0){
					$actualDate = strtotime($actualDate);
					if (date("z",$endDate) !== date("z",$actualDate))
					{
						$duration = $this->calculateDuration($startDate,$actualDate);
						$duration = $duration-1;
						if ($duration !== 0){
							for($i = 1; $i <= $duration;$i++){
								$return .= '<td class="emptyTD"></td>';
							}
							//$return .= '<td colspan="'.$duration.'"></td>';
						}
					}
				}
				
				//make a td with a colspan from ##zero## until enddate //alternatively from the last task due date
				//use php date function to get it.
				
				$duration = $this->calculateDuration($endDate,$startDate);
				
				
				if ($duration !== 0){
					$duration = $duration+1;
				}
				
				$return .= '<td colspan="'.$duration.'" class="'.$primaryTask["name"].' projectMainDates"><div class="primaryTaskName">'.$primaryTask["name"].'</div></td>';
				
				
				//now return the task itself
				$actualDate = $primaryTask['enddate'];
				
			}//end of if, that is checking if task is in valuable Range
	    }//end of while for eah simple Task		
		if ($actualDate !== 0) {
	    $actualDate = strtotime($actualDate);
			$duration = $this->calculateDuration(GLB::$lastDay,$actualDate);
			if ($duration !== 0){
				for($i = 1; $i <= $duration;$i++){
					$return .= '<td class="emptyTD"></td>';
				}
				//$return .= '<td colspan="'.$duration.'"></td>';
			}
		}
		
	    return $return;
	}
	
	//allowed are time values, so do a stingttotime before inserting the variabled here
	private function calculateDuration($endDate,$startDate)
	{
		$duration = $endDate - $startDate;
		$duration = $duration/"86400";
		return $duration;
	}
}
?>