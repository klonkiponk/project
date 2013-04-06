<?php require_once('php/inc.sessionCheck.php');?>
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

<h2  class="icon-bookmark">Projekt anlegen</h2>
<?php
		if($_SESSION['role']==99){

		$newProject = new editProject();
		echo $newProject->newProjectForm();
}
?>
</div><?php /*editWrapper end*/?>
<?php include('php/html/inc.footer.php')?>

</div><?php /*wrapper end */?>
</body>
</html>