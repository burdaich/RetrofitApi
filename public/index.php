<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Exception\NotFoundException;

require __DIR__ . '/../vendor/autoload.php';
require '../includes/DbConnect.php';

$app = AppFactory::create();
// Parse json, form data and xml
$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

$app->setBasePath("/MyApi/public");
$app->get('/hello/{name}', function (Request $request, Response $response, $args) {
	$name = $args['name'];
    $response->getBody()->write("Hello, $name");

    $db = new DbConnect;

    if($db->connect() !=null){
        echo 'Connection succesfull';
    }

    return $response;
});

$app->run();