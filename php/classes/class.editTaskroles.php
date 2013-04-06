<?php
class editTaskroles {


	public function getTasksFromDB()
	{
		$sql = "SELECT trid,name,color FROM taskroles";
		$taskroles = $GLOBALS['DB']->query($sql);
		
		$return = '<form action="editTaskroles.php" method="post">';
		$return .= '<select name="trid" class="">';
		while($task = $taskroles->fetch_array())
		{
			$return .= '<option value="'.$task['trid'].'">'.$task['name'].'</option>';
		}
		$return .= '</select>';
		
		
		$return .= '<input class="button delete" type="submit" value="löschen" name="deleteTaskRole">';
		return $return;		
	}
	
	
	public function newTaskForm()
	{
		$sql = "SELECT name FROM colors";
		$colors = $GLOBALS['DB']->query($sql);
		
		$return = '<input type="text" name="taskrolename">';
		$return .= '<select name="color" class="">';
		while($color = $colors->fetch_array())
		{
			$return .= '<option value="'.$color['name'].'">'.$color['name'].'</option>';
		}
		$return .= '</select>';
		
		$return .= '<input type="submit" name="newTaskRole" class="button" value="speichern">';
		
		return $return;
	}
}
?>