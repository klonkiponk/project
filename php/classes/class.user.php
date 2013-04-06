<?php
/**
 * user class.
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
		$sql = "SELECT username FROM users WHERE uid=".$this->uid." AND role <> 99";
		$result = $GLOBALS['DB']->query($sql);
	    $result = $result->fetch_array()
	    return $return['username'];			
	}
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