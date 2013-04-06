<?php
	//DEBUG	print_r($_POST);

	


	foreach($_POST as $key => $value) {
		switch ($key) {
			case "usershortname":
				$usershortname = htmlentities($_POST['usershortname']);
				break;
			case "role":
				$role = $_POST['role'];			
				break;
			case "username":
				$username = $_POST['username'];			
				break;				
			case "uid":
				$uid = $_POST['uid'];
				break;
			case "password":
				$password = md5($_POST['password']);
				break;
			case "hid":
				$hid = $_POST['hid'];	
				break;
			case "startdate":
				$startdate = htmlentities($_POST['startdate']);
				break;
			case "enddate":
				if(empty($_POST['enddate'])){
					$_POST['enddate'] = $_POST['startdate'];
				}
				$enddate = htmlentities($_POST['enddate']);
				break;
			case "ptid":
				$ptid = $_POST['ptid'];
				break;
			case "name":
				$name = htmlentities($_POST['name']);
				break;
			case "color":
				$color = $_POST['color'];
				break;
			case "tid":
				$tid = $_POST['tid'];
				break;
			case "trid":
				$trid = $_POST['trid'];
				break;
			case "pid":
				$pid = $_POST['pid'];
				break;
			case "taskrolename":
				$taskrolename = $_POST['taskrolename'];
				break;
			case "priority":
				$priority = $_POST['priority'];
				break;
			case "description":
				$description = $_POST['description'];
				break;
		}
	}
	
	
	
	/********************\
	
		Person Controls
	
	\********************/
	
	
	if(isset($_POST['editPerson']) AND $_POST['editPerson'] == "speichern"){
		$sql = "UPDATE users SET username='$username',usershortname='$usershortname' WHERE uid='$uid'";
		if ($GLOBALS['DB']->query($sql) == false) {
			echo $GLOBALS['DB']->error;
		} else {
			//echo $GLOBALS['DB']->affected_rows;
		}
	}
	if(isset($_POST['editPerson']) AND $_POST['editPerson'] == "löschen"){
		$sql = "DELETE FROM users WHERE uid='$uid'";
		if ($GLOBALS['DB']->query($sql) == false) {
			echo $GLOBALS['DB']->error;
		} else {
			//echo $GLOBALS['DB']->affected_rows;
		}
	}
	if(isset($_POST['newPerson'])){
		$_POST['password'] = md5($_POST['password']);
		$sql = "INSERT INTO users (usershortname,username,password) VALUES ('$usershortname','$username','$password')";
		if ($GLOBALS['DB']->query($sql) == false) {
			echo $GLOBALS['DB']->error;
		} else {
			//echo $GLOBALS['DB']->affected_rows;
		}
	}
	
	
	/********************\
	
		Person Controls // HOLIDAYS
	
	\********************/
	
	if(isset($_POST['editHoliday']) AND $_POST['editHoliday'] == "löschen"){
		$sql = "DELETE FROM holidays WHERE hid='$hid'";
		if ($GLOBALS['DB']->query($sql) == false) {
			echo $GLOBALS['DB']->error;
		} else {
			//echo $GLOBALS['DB']->affected_rows;
		}
	}
	
	
	if(isset($_POST['newHoliday']) AND $_POST['newHoliday'] == "speichern"){
		
			$sql = "INSERT INTO holidays (uid,startdate,enddate) VALUES ('$uid','$startdate','$enddate')";
		    if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				//echo $GLOBALS['DB']->affected_rows;
		    }
		}
		
		
		
		if(isset($_POST['editHoliday']) AND $_POST['editHoliday'] == "speichern"){
			$sql = "UPDATE holidays SET startdate='$startdate',enddate='$enddate' WHERE hid='$hid'";
			if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				//echo $GLOBALS['DB']->affected_rows;
		    }
		}
	
		/********************\
		
			Project Controls // PRIMARY TASKS
		
		\********************/
	
		if(isset($_POST['primaryTask']) AND $_POST['primaryTask'] == "speichern"){
			$sql = "UPDATE primarytasks SET startdate='$startdate',enddate='$enddate',name='$name',description='$description' WHERE ptid='$ptid'";
			if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				//echo $GLOBALS['DB']->affected_rows;
		    }
		}
		if(isset($_POST['primaryTask']) AND $_POST['primaryTask'] == "löschen"){
			$sql = "DELETE FROM primarytasks WHERE ptid='$ptid'";
		    if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				//echo $GLOBALS['DB']->affected_rows;
		    }
		}
		if(isset($_POST['newPrimaryTask']) AND $_POST['newPrimaryTask'] == "speichern"){
			if(empty($_POST['PTenddate'])){
				$_POST['enddate'] = $_POST['startdate'];
			}
			$sql = "INSERT INTO primarytasks (pid,startdate,enddate,name,description) VALUES ('$pid','$startdate','$enddate','$name','$description')";
		    if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				//echo $GLOBALS['DB']->affected_rows;
		    }
		}
		
		
		
		/********************\
		
			Project Controls // PROJECT DETAILS
		
		\********************/		
		
		if(isset($_POST['editProject']) AND $_POST['editProject'] == "speichern"){
			$sql = "UPDATE projects SET startdate='$startdate',enddate='$enddate',color='$color',name='$name' WHERE pid='$pid'";
			if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				//echo $GLOBALS['DB']->affected_rows;
		    }
		}
		
		if(isset($_POST['editProject']) AND $_POST['editProject'] == "löschen"){
			$sql = "DELETE FROM projects WHERE pid='$pid'";
			if ($GLOBALS['DB']->query($sql) == false) {
				echo $GLOBALS['DB']->error;
			} else {
				//echo $GLOBALS['DB']->affected_rows;
			}
		}			
		
		if(isset($_POST['newProject']) AND $_POST['newProject'] == "speichern"){
			if(empty($_POST['PTenddate'])){
				$_POST['enddate'] = $_POST['startdate'];
			}
			$sql = "INSERT INTO projects (name,startdate,enddate,color) VALUES ('$name','$startdate','$enddate','$color')";
		    if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				//echo $GLOBALS['DB']->affected_rows;
		    }
		}
		/********************\
		
			Project Controls // TASKS
		
		\********************/				

		if(isset($_POST['editTask']) AND $_POST['editTask'] == "löschen"){
			$sql = "DELETE FROM tasks WHERE tid='$tid'";
		    if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				//echo $GLOBALS['DB']->affected_rows;
		    }
		}
		if(isset($_POST['editTask']) AND $_POST['editTask'] == "speichern"){
			$sql = "UPDATE tasks SET startdate='$startdate',enddate='$enddate',trid='$trid',uid='$uid',ordering='$priority' WHERE tid='$tid'";
			if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				//echo $GLOBALS['DB']->affected_rows;
		    }
		}

		if(isset($_POST['newTask']) AND $_POST['newTask'] == "speichern"){
			$sql = "INSERT INTO tasks (startdate,enddate,pid,trid,uid,ordering) VALUES ('$startdate','$enddate','$pid','$trid','$uid','$priority')";
		    if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				//echo $GLOBALS['DB']->affected_rows;
		    }
		}
		
		/********************\
		
			Taskroles
		
		\********************/	
		
		if(isset($_POST['deleteTaskRole']) AND $_POST['deleteTaskRole'] == "löschen"){
			$sql = "DELETE FROM taskroles WHERE trid='$trid'";
		    if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				//echo $GLOBALS['DB']->affected_rows;
		    }
		}		
		

		if(isset($_POST['newTaskRole']) AND $_POST['newTaskRole'] == "speichern"){
			$sql = "INSERT INTO taskroles (name,color) VALUES ('$taskrolename','$color')";
		    if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				//echo $GLOBALS['DB']->affected_rows;
		    }
		}


?>