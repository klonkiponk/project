<?php
/**
 * singleProject class.
 */
class singleProject {
	public $pid;
	public $lastMonth;
	public function __construct($pid)
	{
		$this->pid = $pid;
		$sql = "SELECT name,color,startdate,enddate FROM projects WHERE pid=".$this->pid;
		$result = $GLOBALS['DB']->query($sql);
	    $singleProject = $result->fetch_array();
		$this->projectColor = $singleProject['color'];
		$this->projectName = $singleProject['name'];
		$this->projectStartDate = $singleProject['startdate'];
		$this->projectEndDate = $singleProject['enddate'];
		$this->color = "";
		$this->inputs = "";
		$this->formBegin = "";
		$this->formEnd ="";
		$this->name = "";
		$this->dateInput = "";
	}
	
	public function getDetailsForSingleProjectEditForm ()
	{
		$this->formBegin .= '<form method="post" action="">';

		$this->name .= '<input type="text" class="width200" name="name" id="name" value="'.$this->projectName.'">';

		$this->dateInput .= FORM::startDateInput($this->projectStartDate,"Project",$this->pid);
		$this->dateInput .= "bis&nbsp;&nbsp;&nbsp;&nbsp;";
		$this->dateInput .= FORM::endDateInput($this->projectEndDate,"Project",$this->pid);
		
		$sql = "SELECT name FROM colors GROUP BY name";
		$colors = $GLOBALS['DB']->query($sql);



		

		$this->color = '<select id="color" name="color">';
		while($color = $colors->fetch_array())
			{
				if($color['name'] == $this->projectColor){
					$this->color .= "<option selected value=".$color['name'].">";
					$this->color .= $color['name'];
					$this->color .= "</option>";
				} else {
					$this->color .= "<option value=".$color['name'].">";
					$this->color .= $color['name'];
					$this->color .= "</option>";
				}
			};
		$this->color .= '</select>';		


		
		
		$this->formEnd .= "</form>";
		return $this;
	}
	public function getPrimaryTasksEditForm(){
		$return = new primaryTasks($this->pid);
		return $return->getTasksFromDBEditForm();
	}
	private function getPrimaryTasks()
	{
		$primaryTasks = new primaryTasks($this->pid);
		return $primaryTasks->getTasksFromDB();
	}

	private function getDetailsForSingleProject()
	{
	    $rowspan = $this->userCount + 1;
		$return = '
			<tr class="primaryTasksRow '.$this->projectColor.'">
			<td class="'.$this->projectName.' projectSingleName" rowspan="'.$rowspan.'">
				'.$this->projectName.'
			</td>'."\n";//Count of different Users for this Project: '.$this->userCount.'</td>';
	    return $return;
	}
	public function __toString()
	{
		$return = "";
		$contents = $this->getUserRow();
		$return .= '<!-- DEBUG::NEW PROJECT -->';
		$return .= $this->getDetailsForSingleProject();
		$return .= $this->getPrimaryTasks();
		$return .= "</tr>";
		$return .= $contents;
		return $return;
	}
	/**
	 * getUsersWithTasks function.
	 * Funktion ermittelt wie viele verschiedene Personen für dieses Projekt Aufgaben haben
	 * gibt diese Personen zurück
	 * @access private
	 * @return void
	 */
	private function getUserRow()
	{
		$usersWithTasks = new usersWithTasks($this->pid,$this->projectColor);
		$usersWithTasks->createUserRow();
		$this->userCount = $usersWithTasks->userCount; //now is userCount available for this Project
		return $usersWithTasks->userTasks;
		//return $this->$usersWithTasks->createUserRow->userCount;
	}
}
?>