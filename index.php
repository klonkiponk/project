<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"><!-- erlaubt uns die Nutzung von Umlauten und allen Zeichen-->
    <title>Grundstruktur - Framework</title> <!-- Der Titel der Seite (wird im Tab des Browsers angezeigt)-->        
    <link rel ="stylesheet" href="css/style.css" type="text/css" /> <!--  Bindet unser CSS ein -->
</head>
<body>
<div class="wrapper">
<?php if (!isset($_POST['month']) OR empty($_POST['month'])){
		$_POST['year'] = "2013";
		$_POST['month'] = "01";
	}
?>

<header id="globalHeader">
	Projektübersicht <strong><?php echo $_POST['year']?></strong>
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

<!--<form method="post">
	<label>Year</label>
	<input type="text" name="year" value="2013">
	<label>Month</label>
	<input type="text" name="month" value="01">
	<input type="submit">	
</form>
-->
<?php
	require_once('etc/inc.constants.php');    
    require_once('php/inc.includeClasses.php');
    
	
	
	
	
	
	$overViewDate = $_POST['year']."-".$_POST['month']."-01";
	
	
	
	GLB::$firstMonth = $overViewDate;
	GLB::$lastMonth =  GLB::addOneMonth();
	new dateTimeOperations(GLB::$firstMonth,GLB::$lastMonth);
	
	
    $overview = new overview();
    echo $overview->getAllProjects();
?>
</div>
</body>
</html>