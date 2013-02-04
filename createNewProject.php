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

	if(isset($_POST['createNewProject'])){
		if($_POST['createNewProject'] == true){
			$sql = "INSERT INTO projects (name,startdate,enddate,color) VALUES ('{$_POST['name']}','{$_POST['startdate']}','{$_POST['enddate']}','{$_POST['color']}')";
		    //echo $sql;
			if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				echo $GLOBALS['DB']->affected_rows;
		    }


		}
	}
?>
<form method="post" action="">
	<?php echo FORM::nameInput() ?>
	<?php echo FORM::startDateInput() ?>
	<?php echo FORM::endDateInput() ?>
	<?php echo FORM::colorInput() ;?>
	<?php echo FORM::submitButton("createNewProject");?>
</form>

</div>
</body>
</html>