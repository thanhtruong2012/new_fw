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

    // CRUD
    public function get($id = "", $select = "*"){
        $this->db->select($select);
        if(!empty($id)){
            $this->db->{SBArray::valid($id)?"in":"where"}("user_id",$id);
        }
        if($id == "" || (!empty($id) && SBArray::valid($id))){
            $result = $this->select();
        }else{
            $result = $this->selectOne();
        }
        return $result;
    }

    public function getList($iData, $limit, $offset, $select = "*"){
        $this->db->select($select);
        if(!empty($iData)&&SBArray::valid($iData)){
            foreach ($iData as $keyData => $valueData) 
            {
                $this->db->where($keyData,$valueData);
            }
        }
        $this->db->limit($limit);
        $this->db->offset($offset);
        $result = $this->select();
        return $result;
    }

    public function getCount($iData){
        if(!empty($iData)&&SBArray::valid($iData)){
            foreach ($iData as $keyData => $valueData) 
            {
                $this->db->where($keyData,$valueData);
            }
        }
        $result = $this->selectCount();
        return $result;
    }
}