<?php
namespace WisataKu\WisataKuAPI;
require_once "config/Connection.php";
require_once "config/Util.php";
require_once "model/AccessToken.php";
require_once "model/LocationModel.php";
require_once "model/StatusModel.php";
require_once "model/TourPackageModel.php";
require_once "model/TransactionTourModel.php";




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
                    <a href="tourpackage?location=komodo">
                        GET list of tour packages (filtered)
                    </a>
                </li>
                <li>
                    <a href="tourpackage/1">
                        GET tourpackage/{id} (tourpackage by id)
                    </a>
                </li>
                <li>
                    <a href="oauth/token">
                        POST oauth/token
                    </a><br/>
                        Username and password for LeasingKu = leasingku:p4ssw0rD
                </li>
                <li>
                    <a href="transaction/list/leasingku/7198ef1c0ddddfcbeee593740f390a46bd562572a12fa9f199a1059e42200381e786e8dfa2922bc132aec2df660b0744b2fe9f8f2ee00dc2dcf8805112365e96">
                        GET transaction/list
                    </a><br/>
                    Put all requested parameter in request header, check this out: http://stackoverflow.com/questions/3032643/php-get-request-sending-headers
                </li>
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
                $model = new TourPackageModel();
                $util = new Util();
                $data = $util->objectsToArray($model->getAllTourPackages($_GET));
                if(!empty($data)) {
                    $status = 200;
                } else {
                    $data =  [
                    'status' => 'Error',
                    'message' => 'There is no tour package that match with the requested criteria'];
                    $status = 200;
                }
                return $response->withJson($data, $status);
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
            $this->get('/list', function ($request, $response, $args) {
                $headers = apache_request_headers();
                $model = new AccessToken();
                
                //check token by username is valid
                $isValid = $model->isValidToken($headers['username'], $headers['token']);
                
                if($isValid) {
                    $transaction = new TransactionTourModel();
                    $util = new Util();
                    
                    //get transaction
                    //if any, return transaction list
                    $data = $util->objectsToArray($transaction->getAllTransactions($headers));
                    
                    if(!empty($data)) {
                        $status = 200;
                    } else {
                        $data =  [
                        'status' => 'Error',
                        'message' => 'There is no transaction that match with the requested criteria'];
                        $status = 200;
                    }
                    return $response->withJson($data, $status);
                    
                }
                
                return $response->withJson(
                    [
                        'status' => 'Error',
                        'message' => 'Invalid credential'], 404);    
            });
        });
    }
    
    
    //Get instance of application
    public function get() {
        return $this->app;
    }
    
}