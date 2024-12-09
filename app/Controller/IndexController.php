<?php

namespace App\Controller;

/*custom code added according to
  Allow Slim to instantiate the controller - container resolution
  https://www.slimframework.com/docs/v4/objects/routing.html#allow-slim-to-instantiate-the-controller
*/
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class IndexController
{
    /**
     * Dependency container provided by Slim
     * @var \Slim\Container
     */
    protected $container;

    /**
     * Save dependency container
     * @param \Slim\App $app slim application
     */

    /*
      constructor receives container instance which created/provided by Slim
      Allow Slim to instantiate the controller - container resolution
      https://www.slimframework.com/docs/v4/objects/routing.html#allow-slim-to-instantiate-the-controller

      if the class does not have an entry in the container, then Slim will pass the container’s instance to the constructor. 
      You can construct controllers with many actions instead of an invokable class which only handles one action.

      for info about adding entries to a container see 
      Dependency Container
      https://www.slimframework.com/docs/v4/concepts/di.html

      see ContainerServices class for demonstration of how to access the container object using the Application object 
      i.e. when it is not provided by/without using Slim
    */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

    }

    /**
     * This method is called when the user enters the `/` route
     * @param  \Psr\Http\Message\ServerRequestInterface $request   PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response  PSR7 response
     * @param  array                                    $args      Route parameters
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function index($request, $response, $args)
    {

        $view = $this->container->get('twig');

        return $view->render($response, "index.html.twig");

    }
}
