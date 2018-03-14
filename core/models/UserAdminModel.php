<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 3/14/2018
 * Time: 3:42 PM
 */

class UserAdminModel extends Model
{
    public $table_name = "m099_user_admin";
    public $primary_key = array("user_id");
    public function __construct()
    {
        parent::__construct();
    }

    public function login($user_email,$user_pass,$select="*"){
        $this->db->select($select);
        $this->db->where("user_email",$user_email);
        $this->db->where("user_pass",$user_pass);
        $result = $this->selectOne();
        return $result;
    }
}