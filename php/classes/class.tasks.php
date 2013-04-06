<?php
/**
 * tasks class.
 */
class tasks {
	public $pid;
	public $uid;	
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @param mixed $pid
	 * @return void
	 */
	public function __construct($pid,$uid,$username,$tid="")
	{
		$this->pid = $pid;
		$this->uid = $uid;
		$this->username = $username;
		$this->tid = $tid;
	}
	/**
	 * getTasksfromDB function.
	 * 
	 * @access private
	 */
	public function printTask(){
		$sql = "SELECT trid,startdate,enddate,ordering FROM tasks WHERE pid=".$this->pid." AND uid=".$this->uid." AND tid=".$this->tid." ORDER BY startdate";
		$tasks = $GLOBALS['DB']->query($sql);
		$return = "";
		while ($task = $tasks->fetch_array())
	    {
			$return .= "<form method='post'>";
			$return .= FORM::userSelectWithActive($this->uid);
			$return .= FORM::startDateInputForTasks($task['startdate'],"",$this->tid);
			$return .= "bis&nbsp;&nbsp;&nbsp;&nbsp;";
			$return .= FORM::endDateInputForTasks($task['enddate'],"",$this->tid);
			$return .= FORM::taskrolesSelectWithActive($task['trid']);
			$return .= '<input type="hidden" name="tid" value="'.$this->tid.'">';
			$return .= '<input type="hidden" name="pid" value="'.$this->pid.'">';
			$return .= FORM::prioSelector($task['ordering']);			
			$return .= FORM::submitButton("editTask","speichern","save");
			$return .= FORM::submitButton("editTask","löschen","delete");			
			$return .= "</form>";
		}
		return $return;
	}
	
	
	public function getTasksfromDB()
	{
		$sql = "SELECT tasks.trid,tasks.startdate,tasks.enddate,tasks.tid FROM tasks WHERE tasks.pid=".$this->pid." AND tasks.uid=".$this->uid." ORDER BY tasks.startdate";
		$result = $GLOBALS['DB']->query($sql);
		$return = "";
		$actualDate = GLB::$firstDay;
		
		//DEBUG echo "<br>STARTING ACTUALDATE for this USER: ".date("d.m.Y",$actualDate);
		//DO THIS FOR EVERY SINGLE TASK
	    while ($task = $result->fetch_array())
	    {
		
			//convert the 2013-04-01 Strings to a calculateable Date
			$startDate = strtotime($task['startdate']);
			$endDate = strtotime($task['enddate']);
			
			//Set Startdates to Monday and Enddates to Friday
			$startDate = GLB::setToMondayIfWeekDay($startDate);
			$endDate = GLB::setToFridayIfWeekDay($endDate);
			
			if($startDate <= GLB::$lastDay AND $endDate >= GLB::$firstDay){
				
				//Cut Of The Tasks before the given TimeRange and After the Given TimeRange
				if($startDate < GLB::$firstDay){
					$startDate = GLB::$firstDay;
				}
				if($endDate > GLB::$lastDay){
					$endDate = GLB::$lastDay;
				}
				
				//DEBUG
				//echo "<br>startdate: ".date("d.m.Y",$startDate)."<br>";
				//echo "enddate: ".date("d.m.Y",$endDate)."<br>";
				//echo "tid: ".$task['tid']."<br>";
				//DEBUG
				
				
				if ($startDate !== $actualDate) {
					$return .= GLB::generateEmptyTDs($startDate,$actualDate);
					//now set actualDate to StartDate;
					$actualDate = $startDate;
				}
				
				$trid = $task['trid'];
				$trid = GLB::getNameFromTaskRoles($trid);
				

				if ($startDate == $actualDate) {
					/**********
					
					DO OUTPUT THE TASKS
					
					**********/
					$return .= GLB::generateTask($endDate,$startDate,$task,$trid['color'],$this->username);
					$actualDate = $endDate+86400;
					$actualDate = GLB::setToMondayIfWeekDay($actualDate);
				}
			}
	    }
		/**********
		NOW generate the emptyTDs for the End of The Month*/
		//Here it is Important to get the Last Day also as a Empty Day
		$return .= GLB::generateEmptyTDs(GLB::$lastDay+86400,$actualDate);
		/***********/	
	    
		return $return;
	}
}
?>