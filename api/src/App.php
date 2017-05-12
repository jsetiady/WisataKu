<?php
namespace WisataKu\WisataKuAPI;
require_once "model/TourPackageModel.php";
require_once "model/LocationModel.php";

class App
{
    private $app;
    private $model;
    
    public function __construct() {
        $app = new \Slim\App;
        $app->get('/', function ($request, $response) {
            
            $strMessage = '
            WisataKu API v1.0<br/>
            Available services:
            <ol>
                <li>
                    <a href="location">
                        GET list of locations
                    </a>
                </li>
                <li>
                    <a href="tourpackage">
                        GET list of tour packages
                    </a>
                </li>
            </ol>
            ';
            
            $response->getBody()->write($strMessage);
            return $response;
        });
        
        $this->tourPackageService($app);
        $this->locationService($app);
        
        $this->app = $app;
    }
    
    public function tourPackageService($app) {
        //GET tourpackage/
        $app->group('/tourpackage', function () {
            $isValidId = function ($id) {
                return (int)$id && $id > 0 && $id <= 10;
            };

            $this->map(['GET'], '', function ($request, $response) {
                $model = new TourPackageModel();
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
    
    public function locationService($app) {
        $app->group('/location', function () {
            $isValidId = function ($id) {
                return (int)$id && $id > 0 && $id <= 10;
            };

            $this->map(['GET'], '', function ($request, $response) {
                $model = new LocationModel();
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
    }
    
    //Get instance of application
    public function get() {
        return $this->app;
    }
}