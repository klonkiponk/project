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
	}
	
	public function getDetailsForSingleProjectEditForm ()
	{
		$return = '<h2>Edit an Project</h2>';
		$return .= '<form method="post">';
		$return .= '<label for="name">Name</label><input type="text" name="name" id="name" value="'.$this->projectName.'">';
		
		$return .= FORM::startDateInput($this->projectStartDate,"Project",$this->pid);
		$return .= FORM::endDateInput($this->projectEndDate,"Project",$this->pid);
		
		$sql = "SELECT color FROM projects GROUP BY color ORDER BY color";
		$colors = $GLOBALS['DB']->query($sql);
		$return .= '<label for"color">Farbe</label>
		<select id="color" name="color">';
		while($color = $colors->fetch_array())
			{
				if($color['color'] == $this->projectColor){
					$return .= "<option selected value=".$color['color'].">";
					$return .= $color['color'];
					$return .= "</option>";
				} else {
					$return .= "<option value=".$color['color'].">";
					$return .= $color['color'];
					$return .= "</option>";
				}
			};
		$return .= '</select>';
		$return .= '<input type="hidden" value="'.$this->pid.'">';
		$return .= '<input type="submit" name="project" value="delete">';
		$return .= '<input type="submit" name="project" value="save">';
		$return .= '<input type="hidden" name="pid" value="'.$this->pid.'">';
		$return .= '<input type="hidden" name="editProject" value="true">';
		$return .= "</form>";
		$return .= $this->getPrimaryTasksEditForm();
		return $return;
	}
	private function getPrimaryTasksEditForm(){
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
			</td>';//Count of different Users for this Project: '.$this->userCount.'</td>';
	    return $return;
	}
	public function __toString()
	{
		$contents = $this->getUserRow();
		$return = $this->getDetailsForSingleProject();
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