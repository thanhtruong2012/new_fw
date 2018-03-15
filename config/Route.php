<?php
Router::connect("/",array("module" => "mch_core","controller"=>"Index","action" => "index"));
Router::connect("/admin_login",array("module" => "mch_core","controller"=>"AdminLogin"));
Router::connect("/admin_module",array("module" => "stm_module","controller"=>"AdminModule","action" => "index"));