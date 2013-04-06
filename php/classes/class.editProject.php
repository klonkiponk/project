<?php

class editProject {	

	public function __construct()
	{		
		
	}
	
	public function createEditFormForExistingProject()
	{
		$return = '';
		
		/*
			Details for Project	\\Projektname und Zeitraum
		*/
		
		$return .= '<label class="projectname200 icon-bookmark">Projektname</label><label class="projecttimerange icon-calendar">Zeitraum</label><label class="projectcolor icon-th-large">ProjektFarbe</label><br><br>';
		$singleProject = new singleProject($_POST['pid']);
		$singleProject->getDetailsForSingleProjectEditForm();
		
		$return .= $singleProject->formBegin;
		$return .= $singleProject->name;
		$return .= $singleProject->dateInput;
		$return .= $singleProject->color;
		
		$return .= FORM::submitButton("editProject","speichern","save");
		$return .= FORM::submitButton("editProject","löschen","delete");
		$return .= '<input type="hidden" name="pid" value="'.$_POST['pid'].'">';
		$return .= $singleProject->formEnd;
		
		/*
			PrimaryTasks		\\Termine
		*/
		
		$return .= "<br><br><br>";
		$return .= '<label class="icon-road">Termine</label><br><br>';
		$return .= $singleProject->getPrimaryTasksEditForm();
			
			/*
				neue Termine
			*/
		$newPrimaryTask = new primaryTasks($_POST['pid']);
		$return .= $newPrimaryTask->createNewPrimaryTaskEditForm();

		
		
		/*
			Tätigkeiten			\\Personen mit Aufgaben und Zeiträumen
		*/
		$return .= "<br><br><br>";
		$return .= '<label class="icon-inbox">Aufgaben</label><br><br>';
		$sql = "SELECT tasks.tid,users.uid,users.username FROM tasks,users WHERE tasks.pid={$_POST['pid']} ORDER BY uid";
		$tasks = $GLOBALS['DB']->query($sql);
		
		while($task = $tasks->fetch_array()){
			$task = new tasks($_POST['pid'],$task['uid'],$task['username'],$task['tid']);
			$return .= $task->printTask();
		}
			/*
				neue Tätigkeit
			*/
			$return .= FORM::createNewTaskEditForm($_POST['pid']);

		$return .= '<hr>';
		return $return;
	}
	
	
	
	
	
	
	
	
	
	
	
	public function getAllProjects()
	{
		$sql = "SELECT pid,startdate,enddate FROM projects";
		$result = $GLOBALS['DB']->query($sql);
		$return = '<form method="post" action="editProject.php">';
		$return .= FORM::projectsSelect();
		$return .= FORM::submitButton("","bearbeiten");
		$return .= "</form>";
	    return $return;
	}
	public function newProjectForm(){
		$return = '<form method="post" action="editProjects.php">';
		$return .= '<label class="icon-bookmark projectname">Projektname</label><label class="icon-calendar projecttimerange">Zeitraum</label><label class="projectcolor icon-th-large">ProjektFarbe</label><br><br>';
		$return .= FORM::nameInput();
		$return .= FORM::startDateInput();
		$return .= "bis&nbsp;&nbsp;&nbsp;&nbsp;";
		$return .= FORM::endDateInput();
		$return .= FORM::colorInput();
		$return .= FORM::submitButton("newProject","speichern");
		$return .= '</form>';
		return $return;
	}
}
?>