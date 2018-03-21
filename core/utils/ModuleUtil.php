<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 3/21/2018
 * Time: 9:34 AM
 */

class ModuleUtil extends Util
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel("ModuleModel");
    }

    public function getColumns(){
        $flg = true;
        $oData = array();

        $this->db->beginTransaction();

        $oData = $this->ModuleModel->getColumns();

        if($flg){
            $this->db->commit();
        }else{
            $this->db->rollback();
        }

        return $oData;
    }

    public function getList(){
        $flg = true;
        $oData = array();

        $this->db->beginTransaction();

        $oData = $this->ModuleModel->get();

        if($flg){
            $this->db->commit();
        }else{
            $this->db->rollback();
        }

        return $oData;
    }

    public function getDetail($id){
        $flg = true;
        $oData = array();

        $this->db->beginTransaction();

        $oData = $this->ModuleModel->get($id);

        if($flg){
            $this->db->commit();
        }else{
            $this->db->rollback();
        }

        return $oData;
    }

    public function save($iData){
        $flg = true;
        $oData = array();

        $this->db->beginTransaction();

        $oData = $this->ModuleModel->saveOne($iData);
        if($iData[''])
        if($oData){
            $oData = $this->ModuleModel->get($iData['module_id']);
        }

        if($flg){
            $this->db->commit();
        }else{
            $this->db->rollback();
        }

        return $oData;
    }
}