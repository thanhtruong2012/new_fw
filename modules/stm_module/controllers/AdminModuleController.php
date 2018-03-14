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
    }

    public function index($a='',$b='',$c=''){
        echo $a;die;
        $this->template->content = new View("adminModule/frm");

    }

}