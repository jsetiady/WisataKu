<?php
namespace WisataKu\WisataKuAPI;
require_once "config/Connection.php";
require_once "config/Util.php";
require_once "model/AccessToken.php";
require_once "model/LocationModel.php";
require_once "model/UserModel.php";
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
                        GET tour location/{id} (location by id)
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
                <li>
                    <a href="transaction/new">
                        POST transaction/new
                    </a>
                </li>
                <li>
                    <a href="transaction/confirm/2">
                        PATCH transaction/confirm/{id}
                    </a>
                </li>

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
            
            
            //POST transaction/new
            $this->post('/new', function ($request, $response, $args) {
                
                $headers = apache_request_headers();
                $model = new AccessToken();
                
                //check token by username is valid
                $isValid = $model->isValidToken($headers['username'], $headers['token']);
                
                $errorData =  [
                        'status' => 'Error',
                        'message' => 'Invalid credential or request format'];
                
                $errorDataValue =  [
                        'status' => 'Error',
                        'message' => 'Invalid value of: '];
                
                if($isValid) {
                    //check mandatory parameter
                    if(
                        !isset($_POST['tourId']) || !isset($_POST['totalPerson']) || !isset($_POST['paymentType']) || !isset($_POST['contactName']) || !isset($_POST['contactPhoneNumber']) 
                    ) {
                        $data =  [
                        'status' => 'Error',
                        'message' => 'Missing mandatory parameter'];
                        $status = 404;
                    } else {
                        
                        //check is valid tourId
                        $tourPackageModel = new TourPackageModel();
                        $tourPackage = $tourPackageModel-> getTourPackageByTourId($_POST['tourId'])->toArray();
                        $util = new Util();
                        if(sizeOf($tourPackage)==0) {
                            return $response->withJson($util->getErrorDataValue('tourId'),404);
                        }
                        
                        //check is valid totalPerson
                        if(is_numeric($_POST['totalPerson'])) {
                            if($_POST['totalPerson']<$tourPackage['tourMinPerson'] || $_POST['totalPerson']>$tourPackage['tourMaxPerson']) {
                                return $response->withJson($util->getErrorDataValue('totalPerson. Valid range between '.$tourPackage['tourMinPerson']." to ". $tourPackage['tourMaxPerson']),404);
                            }
                        } else {
                            return $response->withJson($util->getErrorDataValue('totalPerson'),404);
                        }
                        
                        //is valid contactName
                        if($_POST['contactName']=="") {
                             return $response->withJson($util->getErrorDataValue('contactName'),404);
                        }
                        
                        //is valid contactPhoneNumber
                        if(!is_numeric($_POST['contactPhoneNumber'])) {
                        }
                        
                        
                        //check is valid paymentType
                        if(!($_POST['paymentType']=="transfer" || $_POST['paymentType']=="creditcard")) {
                            return $response->withJson($util->getErrorDataValue('paymentType'),404); 
                        }
                        
                        //check mandatory parameter when payment type = cc
                        if($_POST['paymentType']=="creditcard") {
                            if(
                                !isset($_POST['accountName']) || !isset($_POST['accountNumber']) || !isset($_POST['accountBankName'])
                            ) {
                                $data =  [
                                'status' => 'Error',
                                'message' => 'Missing mandatory parameter'];
                                $status = 404;
                                return $response->withJson($data, $status);
                            }
                        }
                        
                        //check from and to date
                        $util = new Util();
                        //1) check if startDate is missing
                        if(!isset($_POST['startDate'])) {
                            $_POST['startDate'] = $tourPackage['tourStartDate'];
                        } else {
                            //if exist, check is format valid
                            if(!$util->validateDate($_POST['startDate'])) {
                                return $util->getErrorDataValue('startDate');
                            }
                        }
                           
                        //1) check if endDate is missing
                        if(!isset($_POST['endDate'])) {
                            $_POST['endDate'] = $tourPackage['tourEndDate'];
                        } else {
                            //if exist, check is format valid
                            if(!$util->validateDate($_POST['endDate'])) {
                                return $response->withJson($util->getErrorDataValue('endDate'),404);
                            }
                        }
                        
                        $insertVal = array(
                            'user' => $headers['username'],
                            'fromDate' => (isset($_POST['startDate']) ? $_POST['startDate'] : $result['startDate']),
                            'toDate' => (isset($_POST['endDate']) ? $_POST['endDate'] : $result['endDate']),
                            'totalPax' => $_POST['totalPerson'],
                            'notes' => (isset($_POST['notes']) ? $_POST['notes'] : "-"),
                            'prefixName' => (isset($_POST['prefixName']) ? $_POST['prefixName'] : "-"),
                            'personName' => $_POST['contactName'],
                            'personContactNo' => $_POST['contactPhoneNumber'],
                            'rentVehicleStat' => '',
                            'paymentType' => ($_POST['paymentType']=="transfer"? "trf" : "cc"),
                            'tourId' => $_POST['tourId'],
                            'pricePerson' => $tourPackage['tourPrice'],
                            'totalPrice' => ($tourPackage['tourPrice'] * $_POST['totalPerson'])
                        );
                           
                        //insert to db
                        $transactionTourModel = new TransactionTourModel();
                        $generatedTransactionId = $transactionTourModel->createTransaction($insertVal);
                        
                        //get recently added transaction
                        $newTransaction = $transactionTourModel->getAllTransactions(array("id" => $generatedTransactionId));
                        $newTransaction = $newTransaction[0]->toArray();
                        
                        $data = array();
                        $data['status'] = 'Success';
                        $data['message'] = 'Transaction created';
                        $data['transaction'] = $newTransaction;
                        $data['invoiceFile'] = INVOICE_FILE_PATH."invoice_".$newTransaction['transactionInvoiceNumber'].".pdf";
                        
                        
                        if(!is_null($data)) {
                            $status = 200;
                        } else {
                            $data =  $errorData;
                            $status = 404;
                        }
                    }
                    return $response->withJson($data, $status);
                } 
                
                return $response->withJson(
                    $errorData, 404); 
            });
            
            
            $this->patch('/confirm/{id}', function ($request, $response, $args) {
                $headers = apache_request_headers();
                $model = new AccessToken();
                
                $errorData =  [
                        'status' => 'Error',
                        'message' => 'Invalid credential or request format'];
                
                if(isset($headers['username']) && isset($headers['token'])) {
                    //check token by username is valid
                    $isValid = $model->isValidToken($headers['username'], $headers['token']);
                } else {
                    return $response->withJson($errorData, $status);
                }
                
                if($isValid) {
                    //check mandatory parameter
                    $input = array();
                    parse_str(file_get_contents('php://input'), $input);
                    
                    if(
                        !isset($input['accountName']) ||
                        !isset($input['accountNumber']) ||
                        !isset($input['accountBankName'])
                    ) {
                         $data =  [
                            'status' => 'Error',
                            'message' => 'Missing mandatory parameter'];
                            $status = 404;
                    }
                    else {
                        //asumsi: kalau confirm pasti non-cc
                
                        //get id transaksi
                        $transaction = new TransactionTourModel();
                        $util = new Util();
                    
                        //get transaction
                        //if any, return transaction list
                        $result = $util->objectsToArray($transaction->getAllTransactions(array('transId' => $args['id'])));
                            
                        if(sizeof($result)>0) {
                            //kalau ketemu, cek sudah bayar atau blm
                            if($result[0]['transactionStatus']['statusId']) {
                                //sudah bayar
                                $data =  [
                                    'status' => 'Error',
                                    'message' => 'This transaction has been paid'];
                                    $status = 404;

                            } else {
                                //kalau belum bayar, cek sudah expired atau belum
                                
                                if(strtotime($result[0]['transactionExpiryDate'])>=strtotime(date("Y-m-d"))) {
                                    
                                    //kalau belum expired, update transaction jadi sudah bayar

                                    $transaction->updateTransactionStatus($result[0]['transactionId'], 1);

                                    //update transaction payment info
                                    $transaction->paymentConfirmation(array(
                                        "invNo" => $result[0]['transactionInvoiceNumber'],
                                        "accName" => $input['accountName'],
                                        "paymentDate" => date("Y-m-d"),
                                        "accNo" => $input['accountNumber'],
                                        "accBank" => $input['accountBankName']
                                    ));

                                    $result = $util->objectsToArray($transaction->getAllTransactions(array('transId' => $args['id'])));
                                    $result = $result[0];

                                    $data =  [
                                        'status' => 'Success',
                                        'message' => 'Payment success',
                                        'transactionInfo' =>
                                            array(
                                                'transactionId' => $result['transactionId'],
                                                'transactionInvoiceNumber' => $result['transactionInvoiceNumber'],
                                                'invoiceFile' => INVOICE_FILE_PATH."invoice_".$result['transactionInvoiceNumber'].".pdf",
                                                'transactionTotalPrice' => $result['transactionTotalPrice'],
                                                'transactionExpiryDate' => $result['transactionExpiryDate']
                                            ),
                                        'transactionStatus' => $result[transactionStatus],
                                        'paymentInfo' => array(
                                            'paymentType' => $result['transactionPaymentInfo']['paymentType'],
                                            'paymentDate' => $result['transactionPaymentInfo']['paymentDate'],
                                            'paymentAccountName' => $result['transactionPaymentInfo']['paymentAccountName'],
                                            'paymentAccountNumber' => $result['transactionPaymentInfo']['paymentAccountNumber'],
                                            'paymentAccountBank' => $result['transactionPaymentInfo']['paymentAccountBank'],
                                        )
                                    ];

                                    $status = 200;
                                } else {
                                    //sudah expired
                                    $data =  [
                                        'status' => 'Error',
                                        'message' => 'Transaction has been expired'];
                                    $status = 404;
                                }
                            }
                        } else {
                            //id tidak valid
                            $data =  [
                            'status' => 'Error',
                            'message' => 'Transaction id not found'];
                            $status = 404;
                        }
                       
                    }
                } else {
                    $data =  $errorData;
                    $status = 404;
                }
                return $response->withJson($data, $status);
            });
            
                        
        });
    }
    
    
    //Get instance of application
    public function get() {
        return $this->app;
    }
    
}