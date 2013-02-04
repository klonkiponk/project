<?php
class GLB {	
	public static $firstMonth;
	public static $lastMonth;
	public static $firstDay;
	public static $lastDay; 
	public static $days;
	
	//function returns string with one Month added to String in this pattern: YYYY-MM-DD
	public static function addOneMonth()
	{
		$exploded = explode("-",GLB::$firstMonth);
		if($exploded[1]!=12){
			$exploded[1]++;
		} else {
			$exploded[1] = 01;
			$exploded[0]++;
		}
		return implode("-",$exploded);
	}
	
}
?>