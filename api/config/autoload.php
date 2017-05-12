<?php
include 'config.php';
require 'vendor/autoload.php';

/*spl_autoload_register(function ($classname) {
    require ("../model/" . $classname . ".php");
});*/

$app = (new WisataKu\WisataKuAPI\App())->get();
