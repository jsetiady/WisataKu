<?php
include 'config.php';
require 'vendor/autoload.php';
spl_autoload_register(function ($classname) {
    require ("../classes/" . $classname . ".php");
});
//$app = new \Slim\App(["settings" => $config]); 

$app = (new WisataKu\WisataKuAPI\App())->get();
