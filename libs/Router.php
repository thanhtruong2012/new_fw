<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 3/14/2018
 * Time: 4:08 PM
 */

class Router
{
    public static $routes = array();
    public static function connect($url,$config)
    {
        if(!(isset($config['module']) && !empty($config['module']))){
            throw new SBException("$url route config module wrong");
        }
        if(!(isset($config['controller']) && !empty($config['controller']))){
            throw new SBException("$url route config controller wrong");
        }
        if(strpos($url,":action") === false && !(isset($config['action'])&&!empty($config['action'])) ){
            throw new SBException("$url route config action wrong");
        }
        /*if(!(isset($config['action']) && !empty($config['action']))){
            throw new SBException("$url route config action wrong");
        }*/
        $url = trim($url,"/");
        self::$routes[$url] = $config;
    }

    public static function getRoute($path)
    {
        $pt = array();
        $pt[] = '/\/:action/';
        $pt[] = '/\/\*/';
        $routeKey = '';
        $route = '';
        if(!empty(self::$routes)){
            foreach(self::$routes as $key => $val){
                $route = preg_replace($pt,"",$key);
                if(!empty($route) && strpos($path,$route) !== false){
                    $routeKey = $key;
                    break;
                }
            }
        }

        $temp = array(
            ":action" => !empty(self::$routes[$routeKey]['action'])?self::$routes[$routeKey]['action']:"",
            "*" => ""
        );

        if($route != $routeKey){
            //replace route vs routeKey
            $seg1 = Url::segmentUri(str_replace($route,"",$routeKey));
            $limit = 1;
            if(in_array(":action",$seg1)){
                $limit = 2;
            }
            //replace route vs path
            $seg2 = Url::segmentUri(str_replace($route,"",$path),$limit);
            $i = 0;
            foreach($temp as $key => $val){
                if(empty($val)){
                    if(in_array($key,$seg1)){
                        $temp[$key] = isset($seg2[$i])?$seg2[$i]:"";
                        $i++;
                    }
                }
            }
        }


        var_dump($temp);die;

        var_dump($seg1);
        var_dump($seg2);
        die;
        return "";
    }




}