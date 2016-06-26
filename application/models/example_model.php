<?php

class Example_model extends Model {
	
	public function getSomething($id)
	{
		$id = (int)$this->escapeString($id);
		$query = sprintf("SELECT * FROM `blog_post` WHERE `id` = %d", $id);
		$result = $this->query($query);
		return $result;
	}

}

?>
