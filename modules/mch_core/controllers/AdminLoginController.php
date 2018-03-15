<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 3/14/2018
 * Time: 2:31 PM
 */

class AdminLoginController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->template = new View("admin/login");
        $this->loadUtil("UserAdminUtil");
    }

    public function index(){
        if (isset($_SESSION['sess_admin']) && !empty($_SESSION['sess_admin']))
            url::redirect(BASE_URL."admin_module");

        if(isset($_POST['btnLogin'])){
            $iData = array(
                'user_email' => addslashes(Request::post('Email')),
                'user_pass' => addslashes(Request::post('Pass')),
            );
            $oData = $this->UserAdminUtil->login($iData);
            if(!empty($oData)){
                $_SESSION['sess_admin'] = $oData;
                Url::redirect(BASE_URL."admin_module");
            }
        }
        $this->template->content = new View("adminLogin/frm");
    }
    
    public function test(){
        //ko dc ab*,ac*,bc*,abc*
        //email
        $pattern = '/^[a-zA-Z0-9-]+/';
        $str = "at+";
        if(preg_match_all($pattern,$str,$matches)>1){
            var_dump(false);
        }else{
            var_dump($matches);
        }
        die;
    }


}