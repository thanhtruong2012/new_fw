<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 3/21/2018
 * Time: 9:35 AM
 */

class ModuleModel extends Model
{
    public $table_name = "m001_module";
    public $primary_key = array("module_id");
    public function __construct()
    {
        parent::__construct();
    }

    public function get($id = "", $select = "*"){
        $this->db->select($select);
        if(!empty($id)){
            $this->db->{SBArray::valid($id)?"in":"where"}("module_id",$id);
        }
        if($id == "" || (!empty($id) && SBArray::valid($id))){
            $result = $this->select();
        }else{
            $result = $this->selectOne();
        }
        return $result;
    }
}