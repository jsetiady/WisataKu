<?php
require_once 'config/autoload.php';

$swagger = \Swagger\scan('src');
header('Content-Type: application/json');
echo $swagger;