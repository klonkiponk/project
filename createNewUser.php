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

	if(isset($_POST['createNewUser'])){
		if($_POST['createNewUser'] == true){
			$_POST['password'] = md5($_POST['password']);
			$sql = "INSERT INTO users (role,usershortname,username,password) VALUES ('{$_POST['role']}','{$_POST['usershortname']}','{$_POST['username']}','{$_POST['password']}')";
		    //echo $sql;
			if ($GLOBALS['DB']->query($sql) == false) {
		        echo $GLOBALS['DB']->error;
		    } else {
				echo $GLOBALS['DB']->affected_rows;
		    }


		}
	}
	
	echo FORM::usersSelect();
	
?>
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