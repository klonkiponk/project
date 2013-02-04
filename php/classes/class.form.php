<?php
class FORM {	
	public static function projectsSelect(){
		$sql = "SELECT pid,name FROM projects";
		$projects = $GLOBALS['DB']->query($sql);
		$return = '<label for"pid">Projekt</label>
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
		$return = '<label for"uid">Person</label>
		<select id="uid" name="uid">';
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
		$return = '<select name="uid">';
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
		$return = '<label for="startdate">startdate</label>
		<input type="text" class="datepicker" id="startdate'.$id.'" name="'.$PT.'startdate" value="'.$date.'">';
		return $return;
	}
	public static function colorInput(){
		$return = '<label for="color">Farbe</label>
		<input type="color" id="color" name="color">';
		
		$sql = "SELECT color FROM projects GROUP BY color";
		$colors = $GLOBALS['DB']->query($sql);
		$return = '<label for"color">Farbe</label>
		<select id="color" name="color">';
		while($color = $colors->fetch_array())
			{
				$return .= "<option value=".$color['color'].">";
				$return .= $color['color'];
				$return .= "</option>";		
			};
		$return .= '</select>';
		
		return $return;
	}
	public static function endDateInput($date = "",$PT= "",$id=""){
		$return = '<label for="enddate">enddate</label>
		<input type="text" class="datepicker" id="enddate'.$id.'" name="'.$PT.'enddate" value="'.$date.'">';
		return $return;
	}
	public static function submitButton($value){
		$return ='<input type="submit" value="true" name="'.$value.'">';
		return $return;
	}
	public static function nameInput(){
		$return = '<label for="name">Name</label><input type="text" name="name" id="name">';
		return $return;
	}
	public static function usernameInput($value=""){
		$return = '<label for="username">Username</label><input type="text" name="username" value="'.$value.'" id="username">';
		return $return;
	}
	public static function usershortnameInput(){
		$return = '<label for="usershortname">UserShortName</label><input type="text" name="usershortname" id="usershortname">';
		return $return;
	}
	public static function userRolesSelect(){
		$sql = "SELECT urid,name FROM userroles";
		$urids = $GLOBALS['DB']->query($sql);
		$return = '<label for"urid">Nutzerrolle</label>
		<select id="urid" name="role">';
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
		$return = '<label for"urid">Nutzerrolle</label>
		<select id="urid" name="role">';
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
		$return = '<label for="password">Passwort</label><input type="text" id="passwort" name="password">';
		return $return;
	}
	
	public static function taskrolesSelect(){
		$sql = "SELECT trid,name FROM taskroles";
		$trids = $GLOBALS['DB']->query($sql);
		$return = '<label for"trid">TaskRole</label>
		<select id="trid" name="trid">';
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
		$return = '<label for"trid">TaskRole</label>
		<select id="trid" name="trid">';
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
		$return = "<h4>New Task</h4>";
		$return .= '<form method="post" action="">';
		$return .= '<input type="hidden" name="pid" value="'.$pid.'">';
		$return .= '<input type="hidden" name="editProject" value="true">';
		$return .= FORM::usersSelect();
		$return .= FORM::taskrolesSelect();
		$return .= FORM::startDateInput();
		$return .= FORM::endDateInput();
		$return .= FORM::submitButton("writeNoteToDB");
		$return .= '</form>';
		
		
		return $return;
	}
}
?>