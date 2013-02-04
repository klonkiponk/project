<?php

class editProject {	

	public function __construct()
	{		
		
	}
	public function getAllProjects()
	{
		$sql = "SELECT pid,startdate,enddate FROM projects";
		$result = $GLOBALS['DB']->query($sql);
		
		$return = "";
		$return .= '<form method="post">';
		$return .= FORM::projectsSelect();
		$return .= FORM::submitButton("editProject");
		$return .= "</form>";
	    return $return;
	}
}
?>