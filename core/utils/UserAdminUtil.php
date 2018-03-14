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
}