<?php
Router::setRoute("/",array("module" => "mch_core","controller"=>"Index","action" => "index"));
Router::setRoute("/admin_login/*",array("module" => "mch_core","controller"=>"AdminLogin","action" => "index"));
Router::setRoute("/test/:action/*",array("module" => "mch_core","controller"=>"Test"));
Router::setRoute("/admin_module/:action/*",array("module" => "stm_module","controller"=>"AdminModule"));
Router::setRoute("/admin_user/:action/*",array("module" => "stm_user","controller"=>"AdminUser"));