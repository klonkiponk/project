<?php require_once('php/inc.sessionCheck.php');
	
//	print_r($_POST);
//	print_r($_SESSION);
	
?>
<!DOCTYPE html>
<html>
<?php include('php/html/inc.head.php')?>
<body>
<div class="wrapper">

<?php
	require_once('etc/inc.constants.php');    
    require_once('php/inc.includeClasses.php');	
	//print_r($_POST);
?>
	
<header id="globalHeader">
	<a class="icon-group" href="index.php">Projektübersicht <strong></strong></a>
	<div class="globalHeaderBox"></div>
</header>

<?php
	include('php/html/inc.nav.php');
	require_once('php/postHandlers.php');	
?>
<div class="editWrapper">

<h2 class="icon-inbox">Aufgaben bearbeiten</h2>
<?php
			if($_SESSION['role']==99){

		$tasks = new editTaskroles();
		echo $tasks->getTasksFromDB();	
}
?>
<h2 class="icon-inbox margin-top50">neue Aufgabenart anlegen</h2>
<?php
	if($_SESSION['role']==99){

		echo $tasks->newTaskForm();
}
?>
</div><?php /*editWrapper end*/?>
<?php include('php/html/inc.footer.php')?>
</div><?php /*wrapper end */?>
</body>
</html>