<?php

/**
 * Slim Framework MVC Boilerplate
 *
 * This file is the starting point of your application.
 *
 * It is responsible for bootstrapping the Slim application itself, dependencies on Dependency-Injection Container,
 * middlewares and routes.
 *
 * You can find more information on Bootstrap\Application class.
 */

 //custom code below
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Selective\BasePath\BasePathMiddleware;

require __DIR__ . '/../vendor/autoload.php';

$application = new Bootstrap\Application;

$app = $application->getAppInstance();

// var_dump($app);

// die;

//REVIEW https://stackoverflow.com/a/71839432

//----------------------selective/basepath---------------------------------
/* 
    the selective/basepath composer package is essentially used to properly set
    the base path so that the route(url) '/' i.e. http://localhost/Slim-MVC-Framework/
    can be rendered 
*/
// Add Slim routing middleware
$app->addRoutingMiddleware();

// Set the base path to run the app in a subdirectory.
// This path is used in urlFor().
$app->add(new BasePathMiddleware($app));

$app->addErrorMiddleware(true, true, true);

// Define app routes
// $app->get('/', function (Request $request, Response $response) {
//     $response->getBody()->write('Hello, World!');
//     return $response;
// })->setName('root');

//--------------------------end of selective/basepath-----------------------------------------------

// $app->setBasePath("/Slim-MVC-Framework/public"); 

// $app->get('/index.php', function (Request $request, Response $response, $args) {
//     $response->getBody()->write("Hello world!");
//      return $response;
//  });
 
// try {
//     $app->run();     
// } catch (Exception $e) {    
//   // We display a error message
//   die( json_encode(array("status" => "failed", "message" => "This action is not allowed"))); 
// }

$app->run();
/* 
the run() method is provided by the Slim framework package so it is only available after the framework is installed 
see C:\laragon\www\slim-php-framework-app\vendor\slim\slim\Slim\App.php
*/
