<?php

namespace WisataKu\WisataKuAPI;

class App
{
    private $app;
    
    public function __construct() {
        $app = new \Slim\App;

        $app->get('/', function ($request, $response) {
            $response->getBody()->write("WisataKu API v1.0");
            return $response;
        });

        $app->group('/tourpackage', function () {
            $isValidId = function ($id) {
                return (int)$id && $id > 0 && $id <= 10;
            };

            $this->map(['GET'], '', function ($request, $response) {
                return $response->withJson(
                    ['message' => 'List Tour Package']
                );
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
    
    //Get instance of application
    public function get()
    {
        return $this->app;
    }
}