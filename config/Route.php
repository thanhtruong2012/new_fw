<?php
Router::setRoute("/",array("module" => "mch_core","controller"=>"Index","action" => "index"));
Router::setRoute("/admin_login/*",array("module" => "mch_core","controller"=>"AdminLogin","action" => "index"));

Router::setRoute("/admin_module/:action/*",array("module" => "stm_module","controller"=>"AdminModule"));
//Router::connect("/admin_module/*",array("module" => "stm_module","controller"=>"AdminModule","action" => "index"));