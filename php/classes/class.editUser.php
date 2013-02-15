<?php
class editUser {	
	public function __construct()
	{		
		
	}
	public function selectUser()
	{
		$return = '';
		$return .= '<form action="editPerson.php" method="post">';
		$return .= FORM::usersSelect();
		$return .= FORM::submitButton("","bearbeiten");
		$return .= '</form>';
		return $return;
	}
	
	
	public function createNewUser()
	{
		$return = "";
		$return .= '<form method="post" action="editPersons.php">';

		$return .= '<label class="icon-user username" for="username">Username</label><label class="usershortname" for="usershortname">Kürzel</label>';
		
//		$return .= '<label class="icon-asterisk password" for="password">Passwort</label>';
//		$return .= '<label class="role icon-sitemap">Rolle</label>';
		$return .= '<br><br>';
		$return .= FORM::usernameInput();
		$return .= FORM::usershortnameInput();
//		$return .= FORM::passwordInput();
//		$return .= FORM::userRolesSelect();
		$return .= FORM::submitButton("newPerson","speichern","");
		$return .= '</form>';	
		
		return $return;
	}
	
	public function editUser()
	{
		$sql = "SELECT username,usershortname,role FROM users WHERE uid=".$_POST['uid'];
		$user = $GLOBALS['DB']->query($sql);
		$user = $user->fetch_array();
		$return = "";
		$return .= '<form method="post" action="editPersons.php">';
		$return .= '<label class="username icon-user" for="username">Username</label><label class="usershortname" for="usershortname">Kürzel</label>';
//		$return .= '<label class="role icon-sitemap">Rolle</label>';
		$return .= '<br><br>';
		$return .=  FORM::usernameInput($user['username']);
		$return .=  '<input type="hidden" name="uid" value="'.$_POST['uid'].'">';
		$return .=  '<input type="text" class="usershortname" name="usershortname" value="'.$user['usershortname'].'">';
//		$return .=  FORM::userRolesSelectWithActive($user['role']);
		$return .=  FORM::submitButton("editPerson","speichern","save");
		$return .=  FORM::submitButton("editPerson","löschen","delete");
		$return .=  '</form>';
		$return .= '<h3 class="icon-gift">Urlaub</h3>';
		$return .=  '<label class="icon-calendar">Zeitraum</label><br><br>';
		$sql = "SELECT hid,startdate,enddate FROM holidays WHERE uid=".$_POST['uid'];
		$holidays = $GLOBALS['DB']->query($sql);		
		while ($this->holiday = $holidays->fetch_array())
		{
			$return .= $this->holidayForm();
		}
		$return .= '<span class="holidayToggler">+</span>';
		$return .= $this->newHolidayForm();
		return $return;
	}
	private function holidayForm()
	{
		$hd = $this->holiday;
		$return = "";
		$return .= '<form method="post">
		<input type="text" class="datepicker" name="startdate" value="'.$hd['startdate'].'">
		<input type="text" class="datepicker" name="enddate" value="'.$hd['enddate'].'">';
		$return .= '<input type="hidden" name="hid" value="'.$hd['hid'].'">';
		$return .=  FORM::submitButton("editHoliday","speichern","save");
		$return .=  FORM::submitButton("editHoliday","löschen","delete");
		$return .=  '<input type="hidden" name="uid" value="'.$_POST['uid'].'">';
		$return .= "</form>";
		return $return;
		
	}
	
	private function newHolidayForm()
	{
		$return = "<form method='post' class='newHoliday hidden'>";
		$return .= '<input type="text" style="margin-right:20px;" class="datepicker" name="startdate">';
		$return .= '<input type="text" class="datepicker" name="enddate">';
		$return .= '<input type="hidden" name="uid" value="'.$_POST['uid'].'">';
		$return .=  FORM::submitButton("newHoliday","speichern","save");		
		$return .= "</form>";
		return $return;
	}
	
}
?>