<?php

namespace Bootstrap;

use App\Controller\AuthController;
use App\Controller\IndexController;

class Router
{
    /**
     * Slim application
     * @var \Slim\App
     */
    private $app;

    /**
     * Save \Slim\App instance
     * @param \Slim\App $app slim application
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Register routes
     * @return void
     */
    public function registerRoutes()
    {
        $this->app->get('/', IndexController::class . ':index')->setName('index');

        $this->app->get('/register', AuthController::class . ':registerView')->setName('register');

        $this->app->post('/register', AuthController::class . ':register');
    }
}
