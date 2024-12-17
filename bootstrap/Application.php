<?php

namespace Bootstrap;

use DI\Container;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use stdClass;

//use DI\Bridge\Slim\Bridge;

require __DIR__ . '/../vendor/autoload.php';
//require 'vendor/autoload.php';

class Application
{
    /**
     * Slim application
     * @var \Slim\App
     */
    private $app;

    /**
     * Bootstrap application
     *
     * - Create \Slim\App instance
     * - Register container services
     * - Register middlewares
     * - Register routes
     */
    public function __construct()
    {
        session_start();

        $this->createAppInstance();

        $this->registerContainerServices();

        $this->registerRoutes();
    }

    /**
     * Get \Slim\App instance
     * @return \Slim\App
     */
    public function getAppInstance()
    {
        return $this->app;
    }

    /**
     * Create \Slim\App instance using application settings
     * @return void
     */
    public function createAppInstance()
    {
        $settings = new Settings(); 
        
        $config = $settings->getConfig();

        $container = new Container();

        $container->set("settings", $config);

        $this->registerDatabase($container);

        AppFactory::setContainer($container); 

        $this->app = AppFactory::create();
    }

    /**
     * Register services on dependency container
     * @return void
     */
    public function registerContainerServices()
    {
        $containerServices = new ContainerServices($this->getAppInstance()); 

        $containerServices->registerAllServices();
    }

    /**
     * Register middlewares
     * @return void
     */
    public function registerMiddlewares()
    {
        $middlewares = new Middlewares($this->getAppInstance());
        $middlewares->registerMiddlewares();
    }

    /**
     * Register routes
     * @return void
     */
    public function registerRoutes()
    {
        $router = new Router($this->getAppInstance());

        $router->registerRoutes();
    }

    public function registerDatabase(Container $container)
    {
        $data = $container->get('settings')['db'];

        $database = new \App\Model\Core\Database(
            "{$data['dbms']}:host={$data['host']};dbname={$data['database']}",
            $data['username'],
            $data['password']
        );

        $database->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $database->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        $database->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        $database->exec("set names utf8");

        $container->set('database', $database);
    }
}
