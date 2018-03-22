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

    /**
     * @return array - table module columns
     */
    public function getColumns(){
        $flg = true;

        $this->db->beginTransaction();

        $oData = $this->ModuleModel->getColumns();

        if($flg){
            $this->db->commit();
        }else{
            $this->db->rollback();
        }

        return $oData;
    }

    /**
     * @return array - list of modules
     */
    public function getList(){
        $flg = true;

        $this->db->beginTransaction();

        $oData = $this->ModuleModel->get();

        if($flg){
            $this->db->commit();
        }else{
            $this->db->rollback();
        }

        return $oData;
    }

    /**
     * @param $id integer - module id
     * @return array - detail of module
     */
    public function getDetail($id){
        $flg = true;

        $this->db->beginTransaction();

        $oData = $this->ModuleModel->get($id);

        if($flg){
            $this->db->commit();
        }else{
            $this->db->rollback();
        }

        return $oData;
    }

    /**
     * @param $iData array - module data is submit from input form
     * @return array - detail of new module
     */
    public function save($iData){
        $flg = true;

        $this->db->beginTransaction();

        if(!empty($iData['module_id'])){
            $oData = $this->ModuleModel->updateOne($iData);
            $module_id = $iData['module_id'];
        }else{
            $oData = $this->ModuleModel->insertOne($iData);
            $module_id = $this->db->lastInsertId();
        }
        
        if($oData){
            $oData = $this->ModuleModel->get($module_id);
        }

        if($flg){
            $this->db->commit();
        }else{
            $this->db->rollback();
        }

        return $oData;
    }
}