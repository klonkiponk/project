<?php
	session_start();

	if (isset($_POST['logout'])){
		session_destroy();
	}

	if (isset($_SESSION['loggedIn'])){
		header('Location:projects.php');
	} else {
	
		require_once('etc/inc.constants.php');
		
		function db_connectToDb ()
		{
		    $mysqli = new mysqli(DBHOST, DBUSER , DBPASSWORD , DATABASE);
		    if (mysqli_connect_errno()) {
		        con_createMessage(mysqli_connect_error(),'red');
		        exit();
		    }
		    return $mysqli;
		}	
	    $DB = db_connectToDb();
	    	
		//DEBUG print_r($_POST);
			
		if(isset($_POST['username'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$sql = "SELECT password,role FROM users WHERE username='$username'";    
		    $result = $GLOBALS['DB']->query($sql);
		    $user = $result->fetch_object();
		    if (empty($user)){
			        header('Location:index.php');
		    } else {
		        if (md5($password) == $user->password) {
		            $_SESSION['loggedIn'] = true;
		            $_SESSION['username'] = $username;
		            $_SESSION['role'] = $user->role;
			        header('Location:projects.php');
		        } else {
			        header('Location:index.php');
		        }
		    }
		} else { //END OF isset(username)
			
			echo "<!DOCTYPE html><html>";
			include('php/html/inc.head.php');
			echo "<body><div class='wrapper'><header id='globalHeader'>
	<a href='index.php' class='icon-group'>Projektübersicht</a>
	<div class='globalHeaderBox'></div>
</header>";
			echo "<form method='post' class='loginForm'>";
			echo '	<label>Username</label>
					<input type="text" name="username">';
			echo '	<label>Passwort</label>
					<input type="password" name="password">';
			echo '<input type="submit" class="button" value="Login">';		
			echo "</form>";
			include('php/html/inc.footer.php');		
			echo "</div></body>";
			echo "</html>";
		}
	}
?>