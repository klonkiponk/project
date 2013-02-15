<?php
	//DEBUGprint_r($_POST);

	
	/********************\
	
		Person Controls
	
	\********************/
	
	
	if(isset($_POST['editPerson']) AND $_POST['editPerson'] == "speichern"){
		$sql = "UPDATE users SET username='{$_POST['username']}',usershortname='{$_POST['usershortname']}',role='{$_POST['role']}' WHERE uid='{$_POST['uid']}'";
		if ($GLOBALS['DB']->query($sql) == false) {
			echo $GLOBALS['DB']->error;
		} else {
			//echo $GLOBALS['DB']->affected_rows;
		}
	}
	if(isset($_POST['editPerson']) AND $_POST['editPerson'] == "löschen"){
		$sql = "DELETE FROM users WHERE uid='{$_POST['uid']}'";
		if ($GLOBALS['DB']->query($sql) == false) {
			echo $GLOBALS['DB']->error;
		} else {
			//echo $GLOBALS['DB']->affected_rows;
		}
	}
	if(isset($_POST['newPerson'])){
		$_POST['password'] = md5($_POST['password']);
		$sql = "INSERT INTO users (role,usershortname,username,password) VALUES ('{$_POST['role']}','{$_POST['usershortname']}','{$_POST['username']}','{$_POST['password']}')";
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
		$sql = "DELETE FROM holidays WHERE hid='{$_POST['hid']}'";
		if ($GLOBALS['DB']->query($sql) == false) {
			echo $GLOBALS['DB']->error;
		} else {
			//echo $GLOBALS['DB']->affected_rows;
		}
	}
	
	
	if(isset($_POST['newHoliday']) AND $_POST['newHoliday'] == "speichern"){
		
			$sql = "INSERT INTO holidays (uid,startdate,enddate) VALUES ({$_POST['uid']},'{$_POST['startdate']}','{$_POST['enddate']}')";
		    if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				//echo $GLOBALS['DB']->affected_rows;
		    }
		}
		
		
		
		if(isset($_POST['editHoliday']) AND $_POST['editHoliday'] == "speichern"){
			$sql = "UPDATE holidays SET startdate='{$_POST['startdate']}',enddate='{$_POST['enddate']}' WHERE hid='{$_POST['hid']}'";
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
			$sql = "UPDATE primarytasks SET startdate='{$_POST['PTstartdate']}',enddate='{$_POST['PTenddate']}',name='{$_POST['PTname']}' WHERE ptid='{$_POST['ptid']}'";
			if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				//echo $GLOBALS['DB']->affected_rows;
		    }
		}
		if(isset($_POST['primaryTask']) AND $_POST['primaryTask'] == "löschen"){
			$sql = "DELETE FROM primarytasks WHERE ptid='{$_POST['ptid']}'";
		    if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				//echo $GLOBALS['DB']->affected_rows;
		    }
		}
		if(isset($_POST['newPrimaryTask']) AND $_POST['newPrimaryTask'] == "speichern"){
			if(empty($_POST['PTenddate'])){
				$_POST['PTenddate'] = $_POST['PTstartdate'];
			}
			$sql = "INSERT INTO primarytasks (pid,startdate,enddate,name) VALUES ({$_POST['pid']},'{$_POST['PTstartdate']}','{$_POST['PTenddate']}','{$_POST['PTname']}')";
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
			$sql = "UPDATE projects SET startdate='{$_POST['Projectstartdate']}',enddate='{$_POST['Projectenddate']}',color='{$_POST['color']}',name='{$_POST['name']}' WHERE pid='{$_POST['pid']}'";
			if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				//echo $GLOBALS['DB']->affected_rows;
		    }
		}
		
		if(isset($_POST['editProject']) AND $_POST['editProject'] == "löschen"){
			$sql = "DELETE FROM projects WHERE pid='{$_POST['pid']}'";
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
			$sql = "DELETE FROM tasks WHERE tid='{$_POST['tid']}'";
		    if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				//echo $GLOBALS['DB']->affected_rows;
		    }
		}
		if(isset($_POST['editTask']) AND $_POST['editTask'] == "speichern"){
			$sql = "UPDATE tasks SET startdate='{$_POST['Taskstartdate']}',enddate='{$_POST['Taskenddate']}',trid='{$_POST['trid']}',uid='{$_POST['uid']}' WHERE tid='{$_POST['tid']}'";
			if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				//echo $GLOBALS['DB']->affected_rows;
		    }
		}

		if(isset($_POST['newTask']) AND $_POST['newTask'] == "speichern"){
			if(empty($_POST['enddate'])){
				$_POST['enddate'] = $_POST['startdate'];
			}
			$sql = "INSERT INTO tasks (startdate,enddate,pid,trid,uid) VALUES ('{$_POST['startdate']}','{$_POST['enddate']}',{$_POST['pid']},{$_POST['trid']},{$_POST['uid']})";
		    if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				//echo $GLOBALS['DB']->affected_rows;
		    }
		}
		
		
		
		
		


?>