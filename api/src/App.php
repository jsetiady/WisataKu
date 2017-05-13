<?php
namespace WisataKu\WisataKuAPI;
require_once "config/Connection.php";
require_once "config/Util.php";
require_once "model/TourPackageModel.php";
require_once "model/LocationModel.php";
require_once "model/AccessToken.php";


/**
 * @SWG\Info(title="WisataKu API",
 description="API E2E Pembelian Paket Wisata",
 version="1.0")
 
 */

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
                        GET list of tour locations
                    </a>
                </li>
                <li>
                    <a href="location/1">
                        GET tour location/:id (location by id)
                    </a>
                </li>
                <li>
                    <a href="tourpackage">
                        GET list of tour packages
                    </a>
                </li>
                <li>
                    <a href="tourpackage/1">
                        GET tourpackage/:id (tourpackage by id)
                    </a>
                </li>
                <li>POST oauth/token</li>
                <li>GET transaction/list</li>
                <li>POST transaction/new</li>
                <li>POST transaction/confirm</li>

            </ol>
            ';
            
            $response->getBody()->write($strMessage);
            return $response;
        });
        
        $this->tourPackageService($app);
        $this->locationService($app);
        $this->oauthService($app);
        $this->transactionService($app);
        
        $this->app = $app;
    }
    
    public function tourPackageService($app) {
        //GET tourpackage/
        $app->group('/tourpackage', function () {
            
            //GET tourpackage/
            $this->map(['GET'], '', function ($request, $response) {
                //print_r($_GET);
                $model = new TourPackageModel();
                $util = new Util();
                $data = $util->objectsToArray($model->getAllTourPackages($_GET));
                return $response->withJson($data);
            });
            
            //GET tourpackage/:id
            $this->get('/{id}', function ($request, $response, $args) {
                $util = new Util();
                if($util->isValidId($args['id'])) {
                    $model = new TourPackageModel();
                    $data = $model->getTourPackageByTourId($args['id']);
                    if(!is_null($data)) {
                        $data = $data->toArray();
                        $status = 200;
                    } else {
                        $data =  [
                        'status' => 'Error',
                        'message' => 'Tour Package with ID:'.$args['id'].' Not Found'];
                        $status = 404;
                    }
                    return $response->withJson($data, $status);
                }
                return $response->withJson(
                    [
                        'status' => 'Error',
                        'message' => 'Tour Package with ID:'.$args['id'].' Not Found'], 404);    
            });
        });
    }
    
    public function locationService($app) {
        $app->group('/location', function () {
            $isValidId = function ($id) {
                return (int)$id && $id > 0 && $id <= 10;
            };
            
            //GET location
            $this->map(['GET'], '', function ($request, $response) {
                $model = new LocationModel();
                $util = new Util();
                $data = $util->objectsToArray($model->getAllLocation());
                return $response->withJson($data);
            });
            
            //GET location/:id
            $this->get('/{id}', function ($request, $response, $args) {
                $util = new Util();
                if($util->isValidId($args['id'])) {
                    $model = new LocationModel();
                    $data = $model->getLocationByLocId($args['id']);
                    if(!is_null($data)) {
                        $data = $data->toArray();
                        $status = 200;
                    } else {
                        $data =  [
                        'status' => 'Error',
                        'message' => 'Location with ID:'.$args['id'].' Not Found'];
                        $status = 404;
                    }
                    return $response->withJson($data, $status);
                }
                return $response->withJson(
                    [
                        'status' => 'Error',
                        'message' => 'Location with ID:'.$args['id'].' Not Found'], 404);    
            });
        });
    }
    
    
    //access token
    public function oauthService($app) {
        $app->group('/oauth', function () {
            
            //generate access token
            $this->post('/token', function ($request, $response, $args) {
                $model = new AccessToken();
                $data = $model->checkAccessToken($_POST['credential']);
                if(!is_null($data)) {
                    $status = 200;
                } else {
                    $data =  [
                    'status' => 'Error',
                    'message' => 'Invalid credential or request format'];
                    $status = 404;
                }
                return $response->withJson($data, $status);    
            });
        });
    }
    
    
   // transaction
    public function transactionService($app) {
        $app->group('/transaction', function () {
            
            //GET transaction/list
            $this->get('/list/{username}/{token}', function ($request, $response, $args) {
                $util = new Util();
                
                //print_r($args);
                
                return $response->withJson(
                    [
                        'status' => 'Error',
                        'message' => 'Location with ID:'.$args['id'].' Not Found'], 404);    
            });
        });
    }
    
    
    //Get instance of application
    public function get() {
        return $this->app;
    }
    
}