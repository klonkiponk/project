<?php

class personOverview {

	public function __construct()
	{
		
	}

	public function printPersonOverview()
	{
		$this->outprint = '<div class="personOverview">';
		$this->outprint .= GLB::generatePreviousNavigation();
		$this->outprint .= GLB::generateNextNavigation();

		//get Count of Days that are Displayed
		$wholeDayCount = GLB::$workDayCountLastMonth + GLB::$workDayCountFirstMonth;		
		$this->outprint .= $this->generateTableHead();	 //begin of the table
		
		
		/**********************\
			start here with the first TRs
		\**********************/
		$sql = "SELECT username, usershortname, uid FROM users";
		$users = $GLOBALS['DB']->query($sql);		
		
		$emptyRowColspan = GLB::$workDayCountFirstMonth+GLB::$workDayCountLastMonth+1;
		$this->outprint .= '<tr><td colspan="'.$emptyRowColspan.'" class="emptyRow"></td></tr>';
		
		//WHAT TO DO FOR EACH USER
		while ($user = $users->fetch_array())
		{
			$sql = "SELECT pid FROM tasks WHERE uid=".$user['uid']." GROUP BY pid";
			$pids = $GLOBALS['DB']->query($sql);
			//Get Count of different projects for this user
			$projectCount = $pids->num_rows;
			$projectCount = $projectCount+1; //increase by one, because holydays is also a <tr>
			$lastTR  = "";
			//create the TD for the username itself and create a complete spanning td for the holydays
			
			//DO IMPROVEMENT HERE
			$this->outprint .= "<tr class='holidays'><td class='singleUser' rowspan='".$projectCount."'>".$user['username']."</td>";
			
			
			$holidays = new holidays($wholeDayCount,$user['uid']);
			
			$this->outprint .= $holidays->returnHolidays();
			
			$this->outprint .= "</tr>";
			
			
			$i = 2;
			while($pid = $pids->fetch_array())
			{
												
			    if ($i == $projectCount) {
				    $lastTR = "lastTR";
			    }
			    $i = $i+1;
				//create for each project a user is working for a TR
				$this->outprint .= "<tr class='".$lastTR."'>";



				
				$sql = "SELECT pid,name,color FROM projects WHERE pid=".$pid['pid'];
				$projects = $GLOBALS['DB']->query($sql);
				
				while ($project = $projects->fetch_array())
				{
					$sql = "SELECT tid,startdate,enddate,trid FROM tasks WHERE pid=".$project['pid']." AND uid=".$user['uid'];
					$tasks = $GLOBALS['DB']->query($sql);
					
					$actualDate = GLB::$firstDay;
					
					while ($task = $tasks->fetch_array())
					{
						//convert the DATE String e.g. 2013-02-01 to a calculateable Date
						$startDate = strtotime($task['startdate']);
						$endDate = strtotime($task['enddate']);
						
						//set Startdates to Monday and Enddates to Friday
						$startDate = GLB::setToMondayIfWeekDay($startDate);
						$endDate = GLB::setToFridayIfWeekDay($endDate);
						
						
						//NOW do the check if a task is in the DateRange
						if($startDate <= GLB::$lastDay AND $endDate >= GLB::$firstDay)
						{
							//NOW we have tasks, that are in the Range... but can be oversized, so cut the days of
							if($startDate < GLB::$firstDay)
							{
								$startDate = GLB::$firstDay;
							}
							if($endDate > GLB::$lastDay)
							{
								$endDate = GLB::$lastDay;
							}
							
							
							
							//DEBUG
							//echo "<br>startdate: ".date("d.m.Y",$startDate)."<br>";
							//echo "enddate: ".date("d.m.Y",$endDate)."<br>";
							//DEBUG
							
							
							/****************\
								EMPTY TD before a TASK
							\****************/
							//CHECK if a Task does not start on the First Day-> create EmptyTDs before start
							if($startDate !== $actualDate)
							{
								$this->outprint .= GLB::generateEmptyTDs($startDate,$actualDate);
								//now set actualDate to StartDate
								$actualDate = $startDate;
							}
							
							
							$trid = $task['trid'];
							$trid = GLB::getNameFromTaskRoles($trid);
							/****************\
								Outprint of the Task
							\****************/
							if($startDate == $actualDate){
								//DEBUG
								//echo $project['color'];
								$this->outprint .= GLB::generatePersonTask($endDate,$startDate,$task,$project['name'],$project['color'],$trid['color'],$trid['name']);
								$actualDate = $endDate+86400;
								$actualDate = GLB::setToMondayIfWeekDay($actualDate);
							}							
							
							
							
							
							
							
						}//END of the Valid Range CheckWHILE
					}
					/****************\
						EMPTYTDs after last Task
					\****************/
					$this->outprint .= GLB::generateEmptyTDs(GLB::$lastDay+86400,$actualDate);
				}//END OF PROJECT
				$this->outprint .= "</tr>";
			}
			//EMPTY ROW AFTER EACH USER
			$this->outprint .= '<tr><td colspan="'.$emptyRowColspan.'" class="emptyRow"></td></tr>';
		}



		/**********************\
			end of tasks
		\**********************/		
		$this->outprint .= $this->generateTableFoot();	 //end of the Table	
		$this->outprint .= "</div>"; //END of personOverview
		return $this;
	}
	
	
	/**
	 * generateTableHead function.
	 * 
	 * @access private
	 * @return void
	 */
	private function generateTableHead()
	{
		$return = '<table><thead>';
		$return .= GLB::$days;
		$return .= '</thead></tbody>';
		return $return;
	}
	
	
	/**
	 * generateTableFoot function.
	 * 
	 * @access private
	 * @return void
	 */
	private function generateTableFoot()
	{
		return '</tbody></table>';
	}
}

?>