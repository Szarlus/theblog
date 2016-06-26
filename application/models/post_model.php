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

    public function __construct()
    {
        $id         = null;
        $title      = null;
        $content    = null;
        $created_by = null;
        $created_on = null;
        $edited_by  = null;
        $edited_on  = null;
        $author     = null;
    }
}


?>