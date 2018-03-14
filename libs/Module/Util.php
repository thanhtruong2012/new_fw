<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 3/14/2018
 * Time: 9:41 AM
 */

class Util
{
    protected $db;
    function __construct(){
        $this->setConn();
    }
    public function setConn($name = "conn1"){
        $this->db = Database::instance($name);
    }
    public function loadModel(){
        $models = func_get_args();
        if(!empty($models)){
            foreach($models as $key => $val){
                App::loadFile(MODEL_PATH.$val.PHP_EXT);
                $this->{$val} = new $val;
            }
        }
    }
}