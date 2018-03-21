<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 3/13/2018
 * Time: 5:03 PM
 */

class Controller
{
    public $actMessage;
    public $template;
    protected $sess_admin;
    protected $sess_client;
    function __construct(){
        $this->actMessage = new FlashMessages();
        $module = Url::getSegment(1);
        if(empty($module)){
            $module = DEFAULT_MODULE;
        }
        $admin_flg = App::checkModule($module,"admin");
        if(!$admin_flg){
            $this->init_client();
        }else{
            $this->init_admin();
        }

    }

    private function init_client(){
        //Url::redirect(BASE_URL."stm_module/adminModule");
    }

    private function  init_admin(){
        if(!(isset($_SESSION["sess_admin"])&&!empty($_SESSION["sess_admin"]))){
            $this->sess_admin = array();
            Url::redirect(Router::getUrl(array("module"=>"mch_core","controller"=>"AdminLogin","action"=>"index")));
        }else{
            $this->sess_admin = $_SESSION["sess_admin"];
        }
    }

    public function setMessage(){
        $this->template->set(array("actMessage"=>$this->actMessage));
    }

    public function getLastQuery(){
        $db = Database::instance();
        return $db->last_query;
    }
    public function getLastSQLError(){
        $db = Database::instance();
        return $db->last_error;
    }
    public function getUpdateId(){
        $db = Database::instance();
        return $db->last_update_id;
    }

    public function loadUtil(){
        $utils = func_get_args();
        if(!empty($utils)){
            foreach($utils as $key => $val){
                App::loadFile(UTIL_PATH.$val.PHP_EXT);
                $this->{$val} = new $val;
            }
        }
    }

}