<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 3/22/2018
 * Time: 9:03 AM
 */

class SBHtml
{
    /**
     * create a html link <a>
    */
    public static function link($attr = array()){
        $str_attr = "";
        if(!empty($attr)){
            $str_attr = implode(" ",array_map(function($v,$k){
                return sprintf("%s='%s'", $k, $v);
            },$attr,SBArray::keys($attr)));
        }
        echo $str_attr;die;
        return $str_attr;
    }
}