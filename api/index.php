<?php
require_once 'config/autoload.php';
require_once 'config/DBConnection.php';

$db = new DBConnection();
               
$app->run();