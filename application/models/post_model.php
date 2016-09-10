<?php

class Post
{
    public $id;
    public $title;
    public $content;
    public $created_by;
    public $created_on;
    public $edited_by;
    public $edited_on;
    public $author;
    public $comments;
    public $comments_count;

    public function __construct()
    {
        $this->id               = null;
        $this->title            = null;
        $this->content          = null;
        $this->created_by       = null;
        $this->created_on       = null;
        $this->edited_by        = null;
        $this->edited_on        = null;
        $this->author           = null;
        $this->comments         = array();
        $this->comments_count   = 0;
    }

}


?>