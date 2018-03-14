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
        /*if(!(isset($config['action']) && !empty($config['action']))){
            throw new SBException("$url route config action wrong");
        }*/
        $url = trim($url,"/");
        self::$routes[$url] = $config;
    }

    public static function url()
    {

    }
}