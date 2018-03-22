<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 3/22/2018
 * Time: 12:36 PM
 */

class TestController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->template = new View("client/empty");
    }

    public function index(){
        if (Request::isPOST()){
            if(Request::post('btnCheck') !== false){
                $prefix = "sOUtH3rNbRe3ze";
                $data = array(
                    "signature" => hash("sha256",$prefix.Request::post("email").Request::post("api_key")),
                    "permission" => Request::post("method"),
                    "server" => "localhost"
                );
                $oData = SBApi::doApi("checker","secureCheck", $data);
                //var_dump($oData);
            }
        }
        $this->template->content = new View("test/frm");
    }
}