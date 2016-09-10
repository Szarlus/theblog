<?php

class Category
{
    public $id;
    public $name;
    public $description;
    public $parent_id;
    public $children;
    public $created_on;

    public function Model()
    {
        $id = null;
        $name = null;
        $description = '';
        $parent_id = null;
        $children = array();
        $created_on = '';
    }
}