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
	 * @return string with primaryTask <td>'s
	 */
	public function printTask(){
		$sql = "SELECT trid,startdate,enddate FROM tasks WHERE pid=".$this->pid." AND uid=".$this->uid." AND tid=".$this->tid." ORDER BY startdate";
		$tasks = $GLOBALS['DB']->query($sql);
		$return = "";
		while ($task = $tasks->fetch_array())
	    {
			$return .= "<form method='post'>";
			$return .= FORM::taskrolesSelectWithActive($task['trid']);
			$return .= FORM::startDateInput($task['startdate'],"Task",$this->tid);
			$return .= FORM::endDateInput($task['enddate'],"Task");
			$return .= '<input type="hidden" name="tid" value="'.$this->tid.'">';
			$return .= FORM::userSelectWithActive($this->uid);
			$return .= '<input type="submit" name="Task" value="delete">';
			$return .= '<input type="submit" name="Task" value="save">';
			$return .= '<input type="hidden" name="pid" value="'.$this->pid.'">';
			$return .= '<input type="hidden" name="editProject" value="true">';
			$return .= "</form>";
		}
		return $return;
	}
	
	
	public function getTasksfromDB()
	{
		$sql = "SELECT tasks.trid,tasks.startdate,tasks.enddate,tasks.tid FROM tasks WHERE tasks.pid=".$this->pid." AND tasks.uid=".$this->uid." ORDER BY tasks.startdate";
		$result = $GLOBALS['DB']->query($sql);
		$return = "";
		$actualDate = 0;
		$endDate = 0;
	    while ($task = $result->fetch_array())
	    {
			$startDate = strtotime($task['startdate']);
			$endDate = strtotime($task['enddate']);
			
			//$startDate <= $this->lastDay AND $endDate >= $this->firstDay
			if($startDate <= GLB::$lastDay AND $endDate >= GLB::$firstDay){
				
				if($startDate < GLB::$firstDay){
					$startDate = GLB::$firstDay;
				}
				if($endDate > GLB::$lastDay){
					$endDate = GLB::$lastDay;
				}
				
				
				//create emptyTDs before the first Entry
				if ($actualDate==0)
				{
					//$actualDateZero = strtotime("2013-01-01");
					if (date("z",$startDate) !== date("z",GLB::$firstDay))
					{
						$duration = $this->calculateDuration($startDate,GLB::$firstDay);
						$j = $actualDate;
						//$return .= '<td colspan="'.$duration.'"></td>';
						for($i = 1; $i <= $duration;$i++){
							$return .= '<td class="emptyTD day'.date("d",$j).'"></td>';
							$j = $j + 86400;
						}
						
					}
					
				}
				
				if($actualDate!=0){
					$actualDate = $actualDate+86400;
					$j = $actualDate;
					if (date("z",$startDate) !== date("z",$actualDate))
					{
						$duration = $this->calculateDuration($startDate,$actualDate);
						//$return .= '<td colspan="'.$duration.'"></td>';
						
						for($i = 1; $i <= $duration;$i++){
							$return .= '<td class="emptyTD day'.date("d",$j).'"></td>';
							$j = $j + 86400;
						}
					}
				}			
				
				$duration = $this->calculateDuration(($endDate+86400),$startDate);
				
				$trid = $task['trid'];
				$trid = $this->getNameFromTaskRoles($trid);
				$return .= "
				
				<td class='singleTask' colspan='".$duration."'>";
				
				if($duration == 1){
					
				}else{
				
				$return .= "			
					<span style='background:".$trid['color']."' class='".$trid['name']." taetigkeitsbox'>
					</span>";
				}
				$return .= "<span class='".$trid['name']."'>".$this->username."</span>
				</td>";
				
				$return .= "";
				
				$actualDate = $endDate;
			}
	    }
		
		//$this->lastMonth = strtotime($this->lastMonth);
		
		//$this->lastMonth = mktime(0,0,0,date("m",$this->lastMonth),date("t",$this->lastMonth),date("Y",$this->lastMonth)); 
		//echo "<br>";echo "<br>";
		//echo date("d.m.Y",$this->lastMonth); //EXAMPLE: 28.02.2013
		//echo "<br>";
		//echo date("d.m.Y",$actualDate);
		//echo "<br>";echo "<br>";
		
		if ($actualDate !== 0) {
			$duration = $this->calculateDuration(GLB::$lastDay,$actualDate);
			//generates emptyTD until the next Task
			if ($duration !== 0){
				$j = $actualDate;
				$j = $j +86400;
				for($i = 1; $i <= $duration;$i++){
					$return .= '<td class="emptyTD day'.date("d",$j).'"></td>';
					$j = $j + 86400;
				}
				//$return .= '<td colspan="'.$duration.'"></td>';
			}
		}
		
	    return $return;
	}
	private function getNameFromTaskRoles($trid)
	{
		$sql = "SELECT name,color FROM taskroles WHERE trid=".$trid;
		$result = $GLOBALS['DB']->query($sql);
		$result = $result->fetch_array();
		return $result;
	}
	private function calculateDuration($endDate,$startDate)
	{
		$duration = $endDate - $startDate;
		$duration = $duration/"86400";
		return $duration;
	}
}
?>