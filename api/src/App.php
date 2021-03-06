<?php
namespace WisataKu\WisataKuAPI;
require_once "config/Connection.php";
require_once "util/Util.php";
require_once "util/AccessToken.php";
require_once "util/smsGateway.php";
require_once "model/LocationModel.php";
require_once "model/UserModel.php";
require_once "model/StatusModel.php";
require_once "model/TourPackageModel.php";
require_once "model/TransactionTourModel.php";
require_once "model/SimpleCRMModel.php";


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
            
            include "util/_header.php";
            ?>
            <div class="py-5">
              <div class="container">
                <div class="row" style="margin:auto">
                  <div class="col-md-12" style="margin:auto;">
                    <h5>WisataKu API v1.0</h5>
                    Available services:
                    <ol>
                        <li>
                            <a href="location">
                                GET /location
                            </a><br/>
                            GET list of tour locations
                        </li>
                        <li>
                            <a href="location/1">
                                GET /location/{id}
                            </a><br/>
                            Get tour location by id location
                        </li>
                        <li>
                            <a href="tourpackage">
                                GET /tourpackage
                            </a><br/>
                            GET list of tour packages<br/>
                            Parameter<br/>
                            <ul>
                                <li>type: optional</li>
                                <li>startDate: optional</li>
                                <li>endDate: optional</li>
                                <li>location: optional</li>
                            </ul>
                        </li>
                        <li>
                            <a href="tourpackage/1">
                                GET /tourpackage/{id}
                            </a><br/>
                            GET tourpackage by id
                        </li>
                        <li>
                            <a href="oauth/token">
                                POST oauth/token
                            </a><br/>
                                Generate new token <br/>
                                Parameter<br/>
                                <ul>
                                <li>credential: optional</li>
                                </ul>
                                Credential = base64 of username:password<br/>
                                Username and password for LeasingKu = leasingku:p4ssw0rD<br/>
                        </li>
                        <li>
                            <a href="transaction/list/leasingku/7198ef1c0ddddfcbeee593740f390a46bd562572a12fa9f199a1059e42200381e786e8dfa2922bc132aec2df660b0744b2fe9f8f2ee00dc2dcf8805112365e96">
                                GET transaction/list
                            </a><br/>
                            Parameter:
                            <ul>
                                <li>username: mandatory</li>
                                <li>token: mandatory</li>
                                <li>transactionStartDate: optional</li>
                                <li>transactionEndDate: optional</li>
                                <li>id: optional</li>
                                <li>invoiceNumber: optional</li>
                                <li>paymentStatus: optional</li>
                            </ul>
                            Put all required parameter in request header, check this out: http://stackoverflow.com/questions/3032643/php-get-request-sending-headers
                        </li>
                        <li>
                            <a href="transaction/new">
                                POST transaction/new
                            </a><br/>
                            Parameter:
                            <ul>
                                <li>username: mandatory</li>
                                <li>token: mandatory</li>
                                <li>tourId: mandatory</li>
                                <li>totalPerson: mandatory</li>
                                <li>contactName: mandatory</li>
                                <li>contactPhoneNumber: mandatory</li>
                                <li>paymentType: mandatory</li>
                                <li>startDate: optional</li>
                                <li>endDate: optional</li>
                                <li>notes: optional</li>
                                <li>accountName: optional</li>
                                <li>accountNumber: optional</li>
                                <li>accountBankName: optional</li>
                            </ul>
                        </li>
                        <li>
                            <a href="transaction/confirm/2">
                                PATCH transaction/confirm/{id}
                            </a><br/>
                            Parameter:
                            <ul>
                                <li>username: mandatory</li>
                                <li>token: mandatory</li>
                                <li>accountName: mandatory</li>
                                <li>accountNumber: mandatory</li>
                                <li>accountBankName: mandatory</li>
                            </ul>
                        </li>
                        <li>
                            <a href="payment">
                                POST payment
                            </a><br/>
                            Payment stubs
                        </li>
                        <li>
                            <a href="crm">
                                GET crm
                            </a><br/>
                            CRM stubs (Get list of user and their points)
                        </li>
                        <li>
                            <a href="crm/jejeisha">
                                GET crm/{username}
                            </a><br/>
                            CRM stubs (Get list points history of user:username)
                        </li>
                        <li>
                            <a href="crm">
                                POST crm
                            </a><br/>
                            Add point to user's CRM account<br/>
                            Parameter:
                            <ul>
                                <li>username: mandatory</li>
                                <li>transactionInvoice: mandatory</li>
                                <li>transactionDate: mandatory</li>
                                <li>productName: mandatory</li>
                                <li>issuer: mandatory</li>
                                <li>point: mandatory</li>
                                <li>contactPhoneNumber: mandatory</li>
                            </ul>
                        </li>
                        <li>
                            <a href="notification/sms">
                                POST notification/sms
                            </a><br/>
                            SMS Gateway Wisataku<br/>
                            Request Parameter:
                            <ul>
                                <li>number: mandatory</li>
                                <li>message: mandatory</li>
                            </ul>
                        </li>
                    </ol>
                    </div>
                  </div>
                </div>
        </div>

            
                  <?php
            include "util/_footer.php";
            
            $response->getBody()->setStatus(200);
            return $response;
        });
        
        $this->tourPackageService($app);
        $this->locationService($app);
        $this->oauthService($app);
        $this->transactionService($app);
        $this->paymentStubs($app);
        $this->crmStubs($app);
        $this->smsNotification($app);
        
        $this->app = $app;
    }
    
    
    public function crmStubs($app) {
        $app->group('/crm', function () {
            
            $this->map(['GET'], '', function ($request, $response) {
                $model = new SimpleCRMModel();
                $data = $model->getTotalPoints();
                $status = 200;
                return $response->withJson($data, $status);
            });
            
            $this->map(['GET'], '/{username}', function ($request, $response, $args) {
                $model = new SimpleCRMModel();
                $data = $model->getTotalPointsByUsername($args['username']);
                $status = 200;
                return $response->withJson($data, $status);
            });
            
            $this->map(['POST'], '', function ($request, $response) {
                $args = array(
                    "username" => $_POST['username'],
                    "transactionInvoice" => $_POST['transactionInvoice'],
                    "transactionDate" => $_POST['transactionDate'],
                    "productName" => $_POST['productName'],
                    "issuer" => $_POST['issuer'],
                    "point" => $_POST['point'],
                    "contactPhoneNumber" => $_POST['contactPhoneNumber']
                );
                
                $model = new SimpleCRMModel();
                $crmId = $model->createTransaction($args);
                
                $data = $model->getPointById($crmId);
                $status = 200;
                
                $post = [
                    'number' => $_POST['contactPhoneNumber'],
                    'message' => $data['message']
                ];
                
                $url = 'http://api.wisataku.jazzle.me/notification/sms';
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

                $response = curl_exec($ch);
                curl_close($ch);
                
                echo json_encode($data);
                
                //return $response->withJson($data, $status);
            });
        });
    }
    
    
    public function paymentStubs($app) {
        $app->group('/payment', function () {
            $this->map(['GET'], '', function ($request, $response) {
                $data =  [
                'message' => 'WisataKu Payment Gateway'];
                return $response->withJson($data, $status);
            });
            
            $this->map(['POST'], '', function ($request, $response) {
                
                $randomVal = rand(0,1);
                if($randomVal<0.5) {
                    $data =  [
                        'status' => 'OK',
                        'message' => 'Payment success'];
                    return $response->withJson($data, 200);
                } else {
                    $data =  [
                        'status' => 'NOK',
                        'message' => 'Payment failed'];
                    return $response->withJson($data, 406);
                }
            });
        });
    }
    
    public function smsNotification($app) {
        $app->group('/notification', function () {
            $this->post('/sms', function ($request, $response, $args) {
                $smsGateway = new SmsGateway('setiady.jessie@gmail.com', 'jeje2017');

                $deviceID = 48725;
                $number = $_POST['number'];
                $message = $_POST['message'];

                $options = [
                //'send_at' => strtotime('+10 minutes'), // Send the message in 10 minutes
                //'expires_at' => strtotime('+1 hour') // Cancel the message in 1 hour if the message is not yet sent
                ];

                $result = $smsGateway->sendMessageToNumber($number, $message, $deviceID, $options);
                return $response->withJson($result, $status);
            });
            
        });
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
                
                $model = new AccessToken();
                
                //check token by username is valid
                $isValid = $model->isValidToken($_POST['username'], $_POST['token']);
                
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
                            return $response->withJson($util->getErrorDataValue('contactPhoneNumber'),404);
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
                            'user' => $_POST['username'],
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
                        $result = $util->objectsToArray($transaction->getAllTransactions(array('id' => $args['id'])));
                            
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