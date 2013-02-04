<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Grundstruktur - Framework</title>
    <link rel ="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
<div class="wrapper">

<header id="globalHeader">
	<a href="index.php">Projektübersicht <strong></strong></a>
	<div class="globalHeaderBox"></div>
</header>

<nav id="globalNav">
	<div class="projectPersonNav">
		<a href="editProject.php">Projekte</a>
		<a href="editUser.php">Personen</a>
	</div>
	<div class="newProjectNav">
		
	</div>
	<hr>
</nav>
<?php
	require_once('etc/inc.constants.php');    
    require_once('php/inc.includeClasses.php');
	
	
	if(isset($_POST['createNewProject'])){
		if($_POST['createNewProject'] == true){
			$sql = "INSERT INTO projects (name,startdate,enddate,color) VALUES ('{$_POST['name']}','{$_POST['startdate']}','{$_POST['enddate']}','{$_POST['color']}')";
		    //echo $sql;
			if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				//echo $GLOBALS['DB']->affected_rows;
		    }
		}
	}
	
	//print_r($_POST);
	
	if(isset($_POST['editProject'])){
		if(isset($_POST['PT']) AND $_POST['PT'] == "save"){
			$sql = "UPDATE primarytasks SET startdate='{$_POST['PTstartdate']}',enddate='{$_POST['PTenddate']}',name='{$_POST['PTname']}' WHERE ptid='{$_POST['ptid']}'";
			if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				//echo $GLOBALS['DB']->affected_rows;
		    }
		}
		if(isset($_POST['PT']) AND $_POST['PT'] == "delete"){
			$sql = "DELETE FROM primarytasks WHERE ptid='{$_POST['ptid']}'";
		    if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				//echo $GLOBALS['DB']->affected_rows;
		    }
		}
		
		if(isset($_POST['Task']) AND $_POST['Task'] == "delete"){
			$sql = "DELETE FROM tasks WHERE tid='{$_POST['tid']}'";
		    if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				//echo $GLOBALS['DB']->affected_rows;
		    }
		}
		if(isset($_POST['Task']) AND $_POST['Task'] == "save"){
			$sql = "UPDATE tasks SET startdate='{$_POST['Taskstartdate']}',enddate='{$_POST['Taskenddate']}',trid='{$_POST['trid']}',uid='{$_POST['uid']}' WHERE tid='{$_POST['tid']}'";
			if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				//echo $GLOBALS['DB']->affected_rows;
		    }
		}
		if(isset($_POST['writePrimaryTaskToDB']) AND $_POST['writePrimaryTaskToDB'] == true){
			$sql = "INSERT INTO primarytasks (pid,startdate,enddate,name) VALUES ({$_POST['pid']},'{$_POST['PTstartdate']}','{$_POST['PTenddate']}','{$_POST['PTname']}')";
		    if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				//echo $GLOBALS['DB']->affected_rows;
		    }
		}
		if(isset($_POST['writeNoteToDB']) AND $_POST['writeNoteToDB'] == true){
			$sql = "INSERT INTO tasks (startdate,enddate,pid,trid,uid) VALUES ('{$_POST['startdate']}','{$_POST['enddate']}',{$_POST['pid']},{$_POST['trid']},{$_POST['uid']})";
		    if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				echo $GLOBALS['DB']->affected_rows;
		    }
		}
		
		
		if(isset($_POST['project']) AND $_POST['project'] == "save"){
			$sql = "UPDATE projects SET startdate='{$_POST['Projectstartdate']}',enddate='{$_POST['Projectenddate']}',color='{$_POST['color']}',name='{$_POST['name']}' WHERE pid='{$_POST['pid']}'";
			if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				//echo $GLOBALS['DB']->affected_rows;
		    }
		}
		
		if(isset($_POST['project']) AND $_POST['project'] == "delete"){
			$sql = "DELETE FROM projects WHERE pid='{$_POST['pid']}'";
			if ($GLOBALS['DB']->query($sql) == false) {
				echo $GLOBALS['DB']->error;
			} else {
				//echo $GLOBALS['DB']->affected_rows;
			}
		}	
		
		$singleProject = new singleProject($_POST['pid']);
		echo $singleProject->getDetailsForSingleProjectEditForm();
		
		$newPrimaryTask = new primaryTasks($_POST['pid']);
		echo $newPrimaryTask->createNewPrimaryTaskEditForm();
		
		$sql = "SELECT tasks.tid,users.uid,users.username FROM tasks,users WHERE tasks.pid={$_POST['pid']} ORDER BY startdate";
		$tasks = $GLOBALS['DB']->query($sql);
		echo "<h4>Tasks</h4>";
		while($task = $tasks->fetch_array()){
			$task = new tasks($_POST['pid'],$task['uid'],$task['username'],$task['tid']);
			echo $task->printTask();
		}
		echo FORM::createNewTaskEditForm($_POST['pid']);
	} else {	
		$projects = new editProject();
		echo $projects->getAllProjects();
		echo "<h2>generate a New Project</h2>";
		echo '<form method="post" action="">';
		echo FORM::nameInput();
		echo FORM::startDateInput();
		echo FORM::endDateInput();
		echo FORM::colorInput();
		echo FORM::submitButton("createNewProject");
		echo '</form>';
	}
?>
</div>
</body>
</html>