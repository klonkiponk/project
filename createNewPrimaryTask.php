<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Grundstruktur - Framework</title>
    <link rel ="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
<div class="wrapper">
<?php
	require_once('etc/inc.constants.php');    
    require_once('php/inc.includeClasses.php');
	
	if(isset($_POST['writePrimaryTaskToDB'])){
		if($_POST['writePrimaryTaskToDB'] == true){
			$sql = "INSERT INTO primarytasks (pid,startdate,enddate,name) VALUES ({$_POST['pid']},'{$_POST['startdate']}','{$_POST['enddate']}','{$_POST['name']}')";
		    if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				echo $GLOBALS['DB']->affected_rows;
		    }
		}
	}
?>
<form method="post" action="">
	<?php echo FORM::projectsSelect();?>
	<?php echo FORM::startDateInput();?>
	<?php echo FORM::endDateInput();?>
	<?php echo FORM::nameInput();?>
	<?php echo FORM::submitButton("writePrimaryTaskToDB");?>
</form>

</div>
</body>
</html>