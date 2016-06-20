<?php

class Example_model extends Model {
	
	public function getSomething($id)
	{
		$id = $this->escapeString($id);
		$result = $this->query("SELECT * FROM `blog_post` WHERE `id`=$id");
		return $result;
	}

}

?>
