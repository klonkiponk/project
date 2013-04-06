<?php require_once('php/inc.sessionCheck.php');
	require_once('etc/inc.constants.php');
?>
<!DOCTYPE html>
<html>
<?php include('php/html/inc.head.php')?>
<body>
<div class="wrapper">
<?php if (!isset($_POST['month']) OR empty($_POST['month'])){
		$_POST['year'] = date("Y");
		$_POST['month'] = date("m");
	}
?>
<header id="globalHeader">
	<a href="index.php" class="icon-group">Projektübersicht <?php echo $_POST['year']?></a>
	<div class="globalHeaderBox"></div>
</header>

<?php include('php/html/inc.nav.php')?>

<?php
    require_once('php/inc.includeClasses.php');
	
	$overViewDate = $_POST['year']."-".$_POST['month']."-01";
	
	
	
	GLB::$firstMonth = $overViewDate;
	GLB::$lastMonth =  GLB::addOneMonth();
	new dateTimeOperations(GLB::$firstMonth,GLB::$lastMonth);
	
	
    $overview = new overview();
    echo $overview->getAllProjects();
?>

<?php include('php/html/inc.footer.php')?>
</div>
</body>
</html>