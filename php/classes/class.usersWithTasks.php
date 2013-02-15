<?php
/**
 * primaryTasks class.
 */
class usersWithTasks {
	public $pid;
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @param mixed $pid
	 * @return void
	 */
	 
	public function __construct($pid,$projectColor="")
	{
		$this->pid=$pid;
		$this->projectColor = $projectColor;
	}
	private function getTasksForUser($uid,$pid)
	{
		$this->tasks = new tasks();
	}
	
	public function createUserRowEditForm(){
		$return = "USERS";
		return $return;
	}
	
	public function createUserRow()
	{
		$sql = "SELECT users.uid,users.usershortname FROM users,tasks WHERE tasks.uid = users.uid and pid=".$this->pid." GROUP BY users.uid";
		$result = $GLOBALS['DB']->query($sql);
	    $this->userCount = $result->num_rows; //ANZAHL USER für Project
		$lastTR = "";		
		$this->userTasks = "";
		$i = 1;
	    while ($singleUser = $result->fetch_array())
	    {
		    if ($i == $this->userCount) {
			    $lastTR = "lastTR";
		    }
			$this->userTasks .= "<tr class='".$this->projectColor." ".$lastTR." userTaskRow".$i."'>";
			$userContent = new tasks($this->pid,$singleUser['uid'],$singleUser['usershortname']);
			$this->userTasks .= $userContent->getTasksfromDB();
			$this->userTasks .= "</tr>";
			$i++;
	    }
		if($i<5){
			$j = 5 - $i;
			for($q = 0;$q<=$j;$q++){
				//not READY		$this->userTasks .= "<tr><td>&nbsp;</td></tr>";
			}
		}
	    return $this;
	}
	
}
?>