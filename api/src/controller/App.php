<?php
namespace WisataKu\WisataKuAPI;
require "model/Model.php";

class App
{
    private $app;
    private $model;
    
    public function __construct() {
        $app = new \Slim\App;
        
        //$data = $model->getLocations();
        $app->get('/', function ($request, $response) {
            $response->getBody()->write("WisataKu API v1.0");
            return $response;
        });
        
        //$this->tourPackageService($app);
        
        //GET location/
        $app->group('/location', function () {
            $isValidId = function ($id) {
                return (int)$id && $id > 0 && $id <= 10;
            };

            $this->map(['GET'], '', function ($request, $response) {
                $model = new Model();
                $data = $model->getLocations();
                
                return $response->withJson($data);
            });
            $this->get('/{id}', function ($request, $response, $args) {
                if(todoIdValid($args['id'])) {
                    return $response->withJson(['message' => "Tour Package ".$args['id']]);
                }
                return $response->withJson(['message' => 'Tour Package Not Found'], 404);    
            });
        });

        $this->app = $app;
    }
    
    public function tourPackageService($app) {
        //GET tourpackage/
        $app->group('/tourpackage', function () {
            $isValidId = function ($id) {
                return (int)$id && $id > 0 && $id <= 10;
            };

            $this->map(['GET'], '', function ($request, $response) {
                $model = new Model();
                $data = $model->getTourPackages();
                
                return $response->withJson($data);
            });
            $this->get('/{id}', function ($request, $response, $args) {
                if(todoIdValid($args['id'])) {
                    return $response->withJson(['message' => "Tour Package ".$args['id']]);
                }
                return $response->withJson(['message' => 'Tour Package Not Found'], 404);    
            });
        });
    }
    
    //Get instance of application
    public function get() {
        return $this->app;
    }
}