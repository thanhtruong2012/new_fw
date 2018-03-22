<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 3/14/2018
 * Time: 2:30 PM
 */

class AdminUserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->template = new View("admin/home");
        $this->loadUtil("UserAdminUtil");
    }

    public function index(){
        $this->__getList();
    }

    public function edit($id,$new_flg = false){
        $this->template->content = new View("adminUser/frm");
        //case create $oData = false
        $oData = false;
        if($new_flg==false){
            $oData = $this->UserAdminUtil->getDetail($id);
        }
        $oColumn = $this->UserAdminUtil->getColumns();
        //case create init empty $oData
        if(empty($oData)){
            if(isset($oColumn) && !empty($oColumn)){
                foreach($oColumn as $keyColumn => $valColumn){
                    $oData[$valColumn['COLUMN_NAME']] = "";
                }
            }
        }

        $oUrl = array(
            "back_url" => Router::getUrl(array("module"=>"stm_user","controller"=>"AdminUser","action"=>"index")),
        );

        if (Request::isPOST()){
            if(Request::post('btnSave') !== false){
                $iData = Request::post("module");
                $oData = $this->UserAdminUtil->save($iData);
                if($oData){
                    $this->actMessage->success("Action Success");
                }else{
                    $this->actMessage->error("Error !");
                }
            }
        }

        $this->template->content->set(array(
            "oData" => $oData,
            "oColumn" => $oColumn,
            "oUrl" => $oUrl
        ));


    }

    public function create(){
        $this->edit("",true);
    }

    /** Delete
     * @param  $id int - user id
     */
    public function delete($id){
        $iData[0] = array('user_id' => $id );

        $flg = $this->UserAdminUtil->delete($iData);

        if($flg){
            $this->actMessage->success("Delete Success");
        }else{
            $this->actMessage->error("Error !");
        }

        Url::redirect(Router::getUrl(array("module"=>"stm_user","controller"=>"AdminUser","action"=>"index")));
    }

    public function search(){
        if (Request::isGET()){
            $iData = SBArray::removeEmpty($_GET);
            $iData = SBArray::removeKeys($iData,array('page'));
            $this->__getList($iData);
        }
    }

    private function __getList($iData = array()){
        // Pagination
        $page = intval(Request::get("page"));
        $page = $page > 1 ? $page : 1;
        $limit = 2;        
        $offset = 0 + ($page - 1) * $limit;

        $this->template->content = new View("adminUser/list");
        $oData = $this->UserAdminUtil->getList($iData,$limit,$offset);
        $count = $oData['size'];
        $oData = $oData['list'];
        if(!empty($oData)){
            foreach($oData as $keyData => $valData){
                $oData[$keyData]["edit_url"] = Router::getUrl(array("module"=>"stm_user","controller"=>"AdminUser","action"=>"edit","*"=>$valData['user_id']));
                $oData[$keyData]["delete_url"] = Router::getUrl(array("module"=>"stm_user","controller"=>"AdminUser","action"=>"delete","*"=>$valData['user_id']));
            }
        }
        $oColumn = $this->UserAdminUtil->getColumns();
        
        $oPagin = new Pagination($page, $count, $limit, Router::getUrl(array("module"=>"stm_user","controller"=>"AdminUser","action"=>"search")));
        
        $oUrl = array(
            "form_url" => Router::getUrl(array("module"=>"stm_user","controller"=>"AdminUser","action"=>"search")),
            "create_url" => Router::getUrl(array("module"=>"stm_user","controller"=>"AdminUser","action"=>"create")),
        );

        $this->template->content->set(array(
            "oData" => $oData,
            "oColumn" => $oColumn,
            "oUrl" => $oUrl,
            "oPagin" => $oPagin
        ));
    }



}