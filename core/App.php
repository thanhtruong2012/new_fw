<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 3/13/2018
 * Time: 3:27 PM
 */
class App{

    protected static $modules = array('client'=>array(),'admin'=>array());

    public static function loadDir($dir){
        foreach (scandir($dir) as $file){
            // directory?
            if (is_dir( $dir.$file ) && substr( $file, 0, 1 ) !== '.' && strpos($file,"views") === false){
                self::loadDir( $dir.$file.'/' );
            }
            // php file?
            if (preg_match( "/". PHP_EXT . "$/i" , $file ) )
            {
                self::loadFile($dir . $file);
            }
        }
    }

    public static function loadFile($path){
        if(file_exists($path)){
            require_once $path;
        }else{
            throw new SBException("$path is not exists");
        }
    }

    public static function autoload(){

        require_once CONFIG_PATH . 'Module.php';

        require_once CONFIG_PATH . 'Route.php';

        require_once CONFIG_PATH . "Config.php";



        if(isset($config["database"]) && !empty($config["database"]))
        {
            foreach($config["database"] as $key => $val){
                Database::instance($key,$val);
            }
        }

        $path = Url::getPathInfo();
        $segments = Url::segmentUri($path);

        if(isset(Router::$routes[$segments[0]])){
            $module  = Router::$routes[$segments[0]]['module'];
            $controller  = Router::$routes[$segments[0]]['controller'];
            $method  = DEFAULT_METHOD;
            if(!empty(Router::$routes[$segments[0]]['action'])){
                $method = Router::$routes[$segments[0]]['action'];
            }else{
                if(isset($segments[1]) && !empty($segments[1])){
                    $method = $segments[1];
                    unset($segments[1]);
                }
            }
            unset($segments[0]);
        }else{
            $module  = DEFAULT_MODULE;
            $controller  = DEFAULT_CONTROLLER;
            $method  = DEFAULT_METHOD;

            $segments = Url::segmentUri();

            if(!empty($segments)){
                foreach($segments as $key => $val){
                    switch ($key){
                        case 1:
                            $module = $segments[$key];
                            break;
                        case 2:
                            $controller = $segments[$key];
                            break;
                        case 3:
                            $method = $segments[$key];
                            break;
                    }
                    if($key <= 3){
                        unset($segments[$key]);
                    }
                }
            }
        }
        App::loadDir(MODULES_PATH.$module.DS);
        $class = ucfirst($controller) ."Controller";

        if(!class_exists($class)){
            throw new SBException("$class is not exists");
        }

        if(!method_exists($class,$method))
        {
            throw new SBException("Function '$method' is not exist.");
        }

        $ReflectionMethod = new ReflectionMethod($class, $method);
        if (!$ReflectionMethod->isPublic())
        {
            throw new SBException("Function '$method' is not exist.");
        }

        $view = $controller."/".$method;
        $controler = new $class;

        if(!empty($segments))
        {
            eval('$controler->{$method}("'.implode('","', $segments).'");');

        } else {
            $controler->{$method}();
        }
        if(empty($controler->template->content)){
            $controler->template->content = new View($view);
        }
        if (method_exists($controler,"setMessage")) {
            $controler->setMessage();
        }
        //START VIEW
        $sess_client = false;
        if(isset($_SESSION["sess_client"])&&!empty($_SESSION["sess_client"])){
            $sess_client = $_SESSION["sess_client"];
        }

        $sess_admin = false;
        if(isset($_SESSION["sess_admin"])&&!empty($_SESSION["sess_admin"])){
            $sess_admin = $_SESSION["sess_admin"];
        }

        //set content value
        $content = '';
        if(isset($controler->template->content)&&!empty($controler->template->content)){
            if(is_a($controler->template->content,"View")){
                foreach($controler->template->content as $key=>$val){
                    if($key=='tsf_filename' || $key=='tsf_filetype'){
                        continue;
                    }
                    Eval("$".$key."=\$val".";");

                }
                $ref = new ReflectionClass($class);
                $fileName = dirname(dirname($ref->getFileName()))."/views/".strtolower($controler->template->content->tsf_filename).".".strtolower($controler->template->content->tsf_filetype);
                if(file_exists($fileName)){
                    ob_start();
                    require $fileName;
                    $content = ob_get_clean();
                }else{
                    //ERROR
                    throw new SBException("Content View Not Exists", 1);
                }
            }else{
                $content = $controler->template->content;
            }
        }



        //set template value
        if(isset($controler->template)&&!empty($controler->template)){
            if(isset($controler->template_param)&&!empty($controler->template_param)){
                foreach($controler->template_param as $key=>$val){
                    if(strtolower($key)!='content'){
                        Eval("$".$key."=\$val".";");
                    }
                }
            }
            foreach($controler->template as $key=>$val){
                if(strtolower($key)!='content'){
                    Eval("$".$key."=\$val".";");
                }
            }

            if(file_exists("template/".$controler->template->tsf_filename.".".$controler->template->tsf_filetype)){
                require "template/".$controler->template->tsf_filename.".".$controler->template->tsf_filetype;
            }else{
                //ERROR
                throw new SBException("Template View Not Exists", 1);
            }
        }
    }

    public static function addModule($name,$type = "client")
    {
        if($type == "admin"){
            self::$modules['admin'][] = $name;
        }else{
            self::$modules['client'][] = $name;
        }
    }

    public static function checkModule($name,$type)
    {
        if($type != "admin"){
            $type = "client";
        }
        return in_array($name,self::$modules[$type]);
    }


}