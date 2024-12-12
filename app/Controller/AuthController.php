<?php

namespace App\Controller;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class AuthController
{
     /**
     * Dependency container provided by Slim
     * @var \Slim\Container
     */
    protected $container;

    protected $view;

    /**
     * Save dependency container
     * @param \Slim\App $app slim application
     */

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        $this->view = $container->get('twig');
    }

    /**
     * This method is called when the user enters the `/register` route
     * @param  \Psr\Http\Message\ServerRequestInterface $request   PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response  PSR7 response
     * @param  array                                    $args      Route parameters
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function registerView($request, $response, $args)
    {
        return $this->view->render($response, 'auth/register.twig');
    }

    /**
     * This method is called when a post request is sent to the `/register` route
     * @param  \Psr\Http\Message\ServerRequestInterface $request   PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response  PSR7 response
     * @param  array                                    $args      Route parameters
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function register($request, $response, $args)
    {
    }
}
