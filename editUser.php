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
	
	//print_r($_POST);
	
	
	
	
	
?>
	
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
	if(isset($_POST['editUser'])){
		if($_POST['editUser'] == true){
		
			if(isset($_POST['User']) AND $_POST['User'] == "save"){
				$sql = "UPDATE users SET username='{$_POST['username']}',usershortname='{$_POST['usershortname']}',role='{$_POST['role']}' WHERE uid='{$_POST['uid']}'";
				if ($GLOBALS['DB']->query($sql) == false) {
					echo $GLOBALS['DB']->error;
				} else {
					//echo $GLOBALS['DB']->affected_rows;
				}
			}
			if(isset($_POST['User']) AND $_POST['User'] == "delete"){
				$sql = "DELETE FROM users WHERE uid='{$_POST['uid']}'";
				if ($GLOBALS['DB']->query($sql) == false) {
					echo $GLOBALS['DB']->error;
				} else {
					//echo $GLOBALS['DB']->affected_rows;
				}
			}
			echo '<form method="post">';
			$sql = "SELECT username,usershortname,role FROM users WHERE uid=".$_POST['uid'];
			$user = $GLOBALS['DB']->query($sql);
			$user = $user->fetch_array();
			echo FORM::usernameInput($user['username']);
			echo '<input type="hidden" name="uid" value="'.$_POST['uid'].'">';
			echo FORM::userRolesSelectWithActive($user['role']);
			echo '<input type="text" name="usershortname" value="'.$user['usershortname'].'">';
			echo '<input type="submit" name="User" value="delete">';
			echo '<input type="submit" name="User" value="save">';
			echo '</form>';
		}
	} else {
		echo '<form method="post">';
		echo FORM::usersSelect();
		echo FORM::submitButton("editUser");
		echo '</form>';
	}
	
	
	
	
	
?>
<h2>Create New User</h2>
<form method="post" action="">
	<?php echo FORM::userRolesSelect() ;?>
	<?php echo FORM::passwordInput() ;?>
	<?php echo FORM::usernameInput() ;?>
	<?php echo FORM::usershortnameInput() ;?>
	<?php echo FORM::submitButton("createNewUser");?>
</form>
</div>
</body>
</html>