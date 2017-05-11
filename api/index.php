<?php
require_once 'config/autoload.php';

$app->get('/', function ($request, $response, $args) {
    $response->getBody()->write("Welcome to WisataKu API 1.0<br/>");
    return $response;
});

//GET tourpackage/list
$app->get('/tourpackage/list', function ($request, $response, $args) {
    $response->getBody()->write("List Tour Package");
    return $response;
});

               
$app->run();

