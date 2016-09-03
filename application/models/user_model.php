<?php

class User extends Model
{
    protected $_id;
    protected $_nickname;
    protected $_first_name;
    protected $_last_name;
    protected $_registered;
    protected $_is_admin;
    protected $_email;
    protected $_salt;
    protected $_password;
    protected $_logged_in;

    public function __construct()
    {
        @parent::__construct();
    }
}