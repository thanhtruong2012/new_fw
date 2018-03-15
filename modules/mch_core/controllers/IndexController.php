<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 3/13/2018
 * Time: 4:22 PM
 */

class IndexController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->template = new View("client/home");
    }

    public function index($a='',$b=''){
        $this->template->content = new View("index/frm");
        echo $a;
        echo $b;die;
    }
}