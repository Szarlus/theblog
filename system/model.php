<?php

class Model  {

	protected $db;

	public function __construct()
	{
		global $config;
		
		$this->db = new mysqli($config['db_host'], $config['db_username'], $config['db_password']) or die('MySQL Connect Error: '. $this->db->connect_error);
		$this->db->select_db($config['db_name']);
	}

	public function __destruct()
	{
		if(isset($this->db))
		{
			$this->db->close() or die('MySQL Error: '. $this->db->error);
		}
	}

	public function escapeString($string)
	{
		return $this->db->real_escape_string($string);
	}

	public function escapeArray($array)
	{
	    array_walk_recursive($array, create_function('&$v', '$v = $this->db->real_escape_string($v);'));
		return $array;
	}
	
	public function to_bool($val)
	{
	    return !!$val;
	}
	
	public function to_date($val)
	{
	    return date('Y-m-d', $val);
	}
	
	public function to_time($val)
	{
	    return date('H:i:s', $val);
	}
	
	public function to_datetime($val)
	{
	    return date('Y-m-d H:i:s', $val);
	}
	
	public function query($qry)
	{
		$result = $this->db->query($qry) or die('MySQL Error: '. $this->db->error);
		$resultObjects = array();

		while($row = mysqli_fetch_object($result)) $resultObjects[] = $row;

		return $resultObjects;
	}

	public function execute($qry)
	{
		$exec = $this->db->query($qry) or die('MySQL Error: '. $this->db->error);
		return $exec;
	}

	public function sanitize($str)
	{
		$str = htmlspecialchars(stripslashes(trim($str)));
		return $str;
	}

	function sanitize_input($string) {
		return $this->db->escape_string($string);
	}

	function sanitize_output($string) {
		return htmlspecialchars($string);
	}

}
?>
