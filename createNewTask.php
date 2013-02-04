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

	if(isset($_POST['writeNoteToDB'])){
		if($_POST['writeNoteToDB'] == true){
			$sql = "INSERT INTO tasks (startdate,enddate,pid,trid,uid) VALUES ('{$_POST['startdate']}','{$_POST['enddate']}',{$_POST['pid']},{$_POST['trid']},{$_POST['uid']})";
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
	<?php echo FORM::usersSelect();?>
	<?php echo FORM::taskrolesSelect();?>
	<?php echo FORM::startDateInput();?>
	<?php echo FORM::endDateInput();?>
	<?php echo FORM::submitButton("writeNoteToDB");?>
</form>

</div>
</body>
</html>