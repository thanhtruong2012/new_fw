<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 3/22/2018
 * Time: 1:21 PM
 */

class SBApi
{
    public static function doApi($method,$func,$post){
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,SBJ_API_URL."$method/$func");
        curl_setopt($ch,CURLOPT_HEADER,false);
        curl_setopt($ch,CURLOPT_HTTPAUTH,CURLAUTH_ANY);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $post);
        $result = curl_exec($ch);
        echo $result;
        curl_close($ch);
        $data = json_decode($result,true);
        return $data;
    }
}