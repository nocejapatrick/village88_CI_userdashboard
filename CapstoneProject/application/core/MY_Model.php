<?php
class MY_Model extends CI_Model {

    public $table_name;

    function __construct()
    {
        parent::__construct();
    }

    public function generate_rand($length){
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGGIJKLMNOPQRSTUVWXYZ';
        $salt = substr(str_shuffle($permitted_chars), 0, $length);
        return $salt;
    }
}