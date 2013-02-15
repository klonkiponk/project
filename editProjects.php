<!DOCTYPE html>
<html>
<?php include('php/html/inc.head.php')?>
<body>
<div class="wrapper">

<header id="globalHeader">
	<a class="icon-group" href="index.php">Projektübersicht <strong></strong></a>
	<div class="globalHeaderBox"></div>
</header>

<?php include('php/html/inc.nav.php')?>

<div class="editWrapper">

	<h2 class="icon-bookmark">Projekt bearbeiten</h2>
	
	<?php
		require_once('etc/inc.constants.php');    
	    require_once('php/inc.includeClasses.php');
		require_once('php/postHandlers.php');	
		$selectProject = new editProject();
		echo $selectProject->getAllProjects();				
	?>
	
	
	<h2 class="icon-bookmark margin-top50">Neues Projekt anlegen</h2>
	<a class="button" href="newProject.php">Neues Projekt anlegen</a>

</div><?php /*editWrapper end*/?>
<?php include('php/html/inc.footer.php')?>
</div><?php /*wrapper end */?>
</body>
</html>