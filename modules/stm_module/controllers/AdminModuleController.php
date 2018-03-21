<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 3/14/2018
 * Time: 2:30 PM
 */

class AdminModuleController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->template = new View("admin/home");
        $this->loadUtil("ModuleUtil");
    }

    public function index(){
        $this->template->content = new View("adminModule/list");
        $oData = $this->ModuleUtil->getList();
        if(!empty($oData)){
            foreach($oData as $keyData => $valData){
                $oData[$keyData]["edit_url"] = Router::getUrl(array("module"=>"stm_module","controller"=>"AdminModule","action"=>"edit","*"=>$valData['module_id']));
                $oData[$keyData]["delete_url"] = Router::getUrl(array("module"=>"stm_module","controller"=>"AdminModule","action"=>"delete","*"=>$valData['module_id']));
            }
        }
        $oColumn = $this->ModuleUtil->getColumns();

        $oUrl = array(
            "form_url" => Router::getUrl(array("module"=>"stm_module","controller"=>"AdminModule","action"=>"search")),
        );

        $this->template->content->set(array(
            "oData" => $oData,
            "oColumn" => $oColumn,
            "oUrl" => $oUrl
        ));
    }

    public function edit($id,$new_flg = false){
        $this->template->content = new View("adminModule/frm");
        //case create $oData = false
        $oData = false;
        if($new_flg==false){
            $oData = $this->ModuleUtil->getDetail($id);
        }
        $oColumn = $this->ModuleUtil->getColumns();
        //case create init empty $oData
        if(empty($oData)){
            if(isset($oColumn) && !empty($oColumn)){
                foreach($oColumn as $keyColumn => $valColumn){
                    $oData[$valColumn['COLUMN_NAME']] = "";
                }
            }
        }

        $oUrl = array(
            "back_url" => Router::getUrl(array("module"=>"stm_module","controller"=>"AdminModule","action"=>"index")),
        );

        if (Request::isPOST()){
            if(Request::post('btnSave') !== false){
                $iData = Request::post("module");
                $oData = $this->ModuleUtil->save($iData);
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

    public function delete(){
        echo "delete";die;
    }



}