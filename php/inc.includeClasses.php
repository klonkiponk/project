<?php
	/**
	 * connects to database, returns Message or Object
	 *
	 * @return void
	 * @author Kevin Siegerth
	 */
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
    

	
	include_once('php/classes/class.glb.php');
	include_once('php/classes/class.form.php');
	include_once('php/classes/class.primaryTasks.php');
	include_once('php/classes/class.singleProject.php');
	include_once('php/classes/class.overview.php');
	include_once('php/classes/class.usersWithTasks.php');
	include_once('php/classes/class.tasks.php');
	include_once('php/classes/class.dateTimeOperations.php');
	include_once('php/classes/class.editProject.php');
	include_once('php/classes/class.editUser.php');
	include_once('php/classes/class.personOverview.php');
	include_once('php/classes/class.holidays.php');
	include_once('php/classes/class.editTaskroles.php');
	
?>