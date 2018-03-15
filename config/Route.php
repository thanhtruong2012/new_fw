<?php
Router::connect("/",array("module" => "mch_core","controller"=>"Index","action" => "index"));
Router::connect("/admin_login/",array("module" => "mch_core","controller"=>"AdminLogin","action" => "index"));
Router::connect("/admin_module/list/:action/*",array("module" => "stm_module","controller"=>"AdminModule"));