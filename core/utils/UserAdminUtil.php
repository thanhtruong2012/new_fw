<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 3/14/2018
 * Time: 3:07 PM
 */

class UserAdminUtil extends Util
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel("UserAdminModel");
    }

    public function login($iData){
        $flg = true;
        $oData = array();

        $this->db->beginTransaction();

        $oData = $this->UserAdminModel->login($iData['user_email'],$iData['user_pass']);

        if($flg){
            $this->db->commit();
        }else{
            $this->db->rollback();
        }

        return $oData;
    }

    // CRUD
    public function getColumns(){
        $flg = true;
        $oData = array();

        $this->db->beginTransaction();

        $oData = $this->UserAdminModel->getColumns();

        if($flg){
            $this->db->commit();
        }else{
            $this->db->rollback();
        }

        return $oData;
    }

    public function getList($iData,$limit,$offset){
        $flg = true;
        $oData = array();

        $this->db->beginTransaction();

        $oData['list'] = $this->UserAdminModel->getList($iData,$limit,$offset);
        $oData['size'] = $this->UserAdminModel->getCount($iData);

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

        $oData = $this->UserAdminModel->get($id);

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
        
        $user_id = 0;
        if(!empty($iData['user_id'])){
            $oData = $this->UserAdminModel->updateOne($iData);
            $user_id = $iData['user_id'];
        }else{
            $oData = $this->UserAdminModel->insertOne($iData);
            $user_id = $this->db->lastInsertId();
        }
     
        if($oData){
            $oData = $this->UserAdminModel->get($user_id);
        }

        if($flg){
            $this->db->commit();
        }else{
            $this->db->rollback();
        }

        return $oData;
    }

    /**
     * @param $iData array - $iData[] = array('user_id'=>'1')
     * @return return boolean
     */
    public function delete($iData)
    {       
        $flg = true;
        $oData = false;
        $this->db->beginTransaction();

        if(!empty($iData)&&SBArray::valid($iData)){
            foreach ($iData as $keyData => $valData) {                
                $oData = $this->UserAdminModel->deleteOne($valData);
            }
        }
        $flg = empty($this->db->last_error) ? true : false;
        if($flg){
            $this->db->commit();
        }else{
            $this->db->rollback();
        }

        return $oData;
    }

}