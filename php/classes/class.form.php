<?php
class FORM {	
	public static function projectsSelect(){
		$sql = "SELECT pid,name FROM projects";
		$projects = $GLOBALS['DB']->query($sql);
		$return = '
		<select id="pid" name="pid">';
		while($project = $projects->fetch_array())
			{
				$return .= "<option value=".$project['pid'].">";
				$return .= $project['name'];
				$return .= "</option>";		
			};
		$return .= '</select>';
		return $return;
	}
	public static function usersSelect(){
		$sql = "SELECT uid,username FROM users";
		$users = $GLOBALS['DB']->query($sql);
		$return = '<select id="uid" name="uid" class="userSelect">';
		while($user = $users->fetch_array())
			{
				$return .= "<option value=".$user['uid'].">";
				$return .= $user['username'];
				$return .= "</option>";		
			};
		$return .= '</select>';
		return $return;
	}
	
	public static function userSelectWithActive($current)
	{
		$sql = "SELECT username,uid FROM users GROUP BY username ORDER BY username";
		$users = $GLOBALS['DB']->query($sql);
		$return = '<select name="uid" class="userSelect">';
		while($user = $users->fetch_array())
		{
			if($user['uid'] == $current){
					$return .= "<option selected value=".$user['uid'].">";
					$return .= $user['username'];
					$return .= "</option>";
			} else {
					$return .= "<option value=".$user['uid'].">";
					$return .= $user['username'];
					$return .= "</option>";
			}
		};
		$return .= "</select>";
		return $return;
	}
	public static function startDateInput($date = "",$PT= "",$id=""){
		$return = '<input type="text" class="date datepicker" id="startdate'.$id.$PT.'" name="'.$PT.'startdate" value="'.$date.'">';
		return $return;
	}
	public static function startDateInputForTasks($date = "",$PT= "",$id=""){
		$return = '<input type="text" class="date datepicker" id="startdatefortasks'.$id.$PT.'" name="'.$PT.'startdate" value="'.$date.'">';
		return $return;
	}
	public static function colorInput(){
		$return = '<label for="color">Farbe</label>
		<input type="color" id="color" name="color">';
		
		$sql = "SELECT name FROM colors GROUP BY name";
		$colors = $GLOBALS['DB']->query($sql);
		$return = '<select id="color" name="color">';
		while($color = $colors->fetch_array())
			{
				$return .= "<option value=".$color['name'].">";
				$return .= $color['name'];
				$return .= "</option>";		
			};
		$return .= '</select>';
		
		return $return;
	}
	public static function endDateInput($date = "",$PT= "",$id=""){
		$return = '<input type="text" class="date datepicker" id="enddate'.$id.$PT.'" name="'.$PT.'enddate" value="'.$date.'">';
		return $return;
	}
	public static function endDateInputForTasks($date = "",$PT= "",$id=""){
		$return = '<input type="text" class="date datepicker" id="enddatefortasks'.$id.$PT.'" name="'.$PT.'enddate" value="'.$date.'">';
		return $return;
	}
	public static function submitButton($name,$value="true",$class=""){
		$return ='<input class="button '.$class.'" type="submit" value="'.$value.'" name="'.$name.'">';
		return $return;
	}
	public static function nameInput(){
		$return = '<input type="text" name="name" id="name">';
		return $return;
	}
	public static function usernameInput($value=""){
		$return = '<input type="text" name="username" value="'.$value.'" id="username">';
		return $return;
	}
	public static function usershortnameInput(){
		$return = '<input type="text" maxlength="2" name="usershortname" class="usershortname">';
		return $return;
	}
	public static function userRolesSelect(){
		$sql = "SELECT urid,name FROM userroles";
		$urids = $GLOBALS['DB']->query($sql);
		$return = '<select id="urid" name="role">';
		while($urid = $urids->fetch_array())
			{
				$return .= "<option value=".$urid['urid'].">";
				$return .= $urid['name'];
				$return .= "</option>";		
			};
		$return .= '</select>';
		return $return;
	}
	public static function userRolesSelectWithActive($current){
		$sql = "SELECT urid,name FROM userroles";
		$urids = $GLOBALS['DB']->query($sql);
		$return = '<select id="urid" name="role">';
		while($urid = $urids->fetch_array())
		{
			if($urid['urid'] == $current){
				$return .= "<option selected value=".$urid['urid'].">";
				$return .= $urid['name'];
				$return .= "</option>";
			} else {
				$return .= "<option value=".$urid['urid'].">";
				$return .= $urid['name'];
				$return .= "</option>";
			}
		};
		$return .= '</select>';
		return $return;
	}
	
	
	
	
	
	public static function passwordInput(){
		$return = '<input type="text" id="passwort" name="password">';
		return $return;
	}
	
	public static function taskrolesSelect(){
		$sql = "SELECT trid,name FROM taskroles";
		$trids = $GLOBALS['DB']->query($sql);
		$return = '<select id="trid" name="trid">';
		while($trid = $trids->fetch_array())
			{
				$return .= "<option value=".$trid['trid'].">";
				$return .= $trid['name'];
				$return .= "</option>";		
			};
		$return .= '</select>';
		return $return;
	}
	public static function taskrolesSelectWithActive($current){
		$sql = "SELECT trid,name FROM taskroles";
		$trids = $GLOBALS['DB']->query($sql);
		$return = '<select id="trid" name="trid">';
		while($trid = $trids->fetch_array())
		{
			if($trid['trid'] == $current){
				$return .= "<option selected value=".$trid['trid'].">";
				$return .= $trid['name'];
				$return .= "</option>";
			} else {
				$return .= "<option value=".$trid['trid'].">";
				$return .= $trid['name'];
				$return .= "</option>";
			}
		};
		$return .= '</select>';
		return $return;
	}
	public static function createNewTaskEditForm($pid){
		$return = '<span class="taskToggler">+</span>';
		$return .= '<form method="post" action="" class="newTask hidden">';
		$return .= '<input type="hidden" name="pid" value="'.$pid.'">';
		$return .= FORM::usersSelect();
		$return .= FORM::startDateInput();
		$return .= "bis&nbsp;&nbsp;&nbsp;&nbsp;";
		$return .= FORM::endDateInput();
		$return .= FORM::taskrolesSelect();
		$return .= FORM::submitButton("newTask","speichern","save");
		$return .= '</form>';
		
		
		return $return;
	}
}
?>