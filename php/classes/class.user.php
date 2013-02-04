<?php
/**
 * primaryTasks class.
 */
class user {
	public $uid;
	
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @param mixed $pid
	 * @return void
	 */
	public function __construct($uid)
	{
		$this->tid=$uid;
		return $this->getUsername();
	}

	private function getUsername()
	{
		$sql = "SELECT username FROM users WHERE uid=".$this->uid;
		$result = $GLOBALS['DB']->query($sql);
	    $result = $result->fetch_array()
	    return $return['username'];			
	}
	public function 	
	SELECT users.username, COUNT(tasks.pid)
	FROM users
	LEFT JOIN users.uid ON tasks.uid = users.uid
	GROUP BY users.uid
	
	/**
	 * __destruct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __destruct()
	{
	//	unset($this)//GOOGLE if right
	}
}
?>