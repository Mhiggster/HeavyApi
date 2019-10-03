<?php
namespace Pool\Acme;

use Illuminate\Container\Container;


class Router
{
    /**
     * URI Path 
     * 
     * @var string
     */
    protected $uri;
    
    /**
     * Method type
     *
     * @var string
     */
    protected $httpMethod;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $routeActions;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $controllerContains;

    /**
     * Router Consturcotr
     */
    public function __construct()
    {
        $this->uri                = $_SERVER['REQUEST_URI'];
        $this->httpMethod         = $_SERVER['REQUEST_METHOD'];
        $this->controllerContains = '\Pool\Pages\\';
        $this->routeActions       = [];
    }

    /**
     * Load our router rules
     * 
     * @param FastRoute\RouteCollector $router
     */
    public function includeRoutes(\FastRoute\RouteCollector $router) : void
    {
        try {
            require __DIR__ . '/../routes.php';
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Trimed Uri
     *
     * @return void
     */
    private function trimedUri() : void
    {
        if (false !== $pos = strpos($this->uri, '?')) {
            $this->uri = substr($this->uri, 0, $pos);
        }
        $this->uri = rawurldecode($this->uri);
    }

    /**
     * make handlers for next proccessing
     *
     * @param \FastRoute\Dispatcher\GroupCountBased $dispatcher
     * @return void
     */
    private function dispatchingHandlers(\FastRoute\Dispatcher\GroupCountBased $dispatcher) : void
    {
        $routeInfo = $dispatcher->dispatch($this->httpMethod, $this->uri);

        switch ($routeInfo[0])
        {
            case \FastRoute\Dispatcher::NOT_FOUND: // 404
                break;
            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED: // 405
                $allowedMethods = $routeInfo[1];
                break;
            case \FastRoute\Dispatcher::FOUND:
                $this->routeActions['handler'] = $routeInfo[1];
                $this->routeActions['vars'] = $routeInfo[2];
                break;
        }
    }

    /**
     * Trimed uri and then make handlers
     * 
     * @param \FastRoute\Dispatcher\GroupCountBased $dispatcher
     * @return \Pool\Acme\Router
     */
    public function setParams(\FastRoute\Dispatcher\GroupCountBased $dispatcher) : Router
    {
        $this->trimedUri();
        $this->dispatchingHandlers($dispatcher);
        return $this;
    }

    /**
     * call proccessing
     *
     * @param [type] $container
     * @return void
     */
    public function callHandler($container) : void
    {
        // get the controller and method
        $controllerHandlers = reset($this->routeActions);
        // get parametrs
        $paramsHandlers = end($this->routeActions);
        // seperate the controller
        $explodeHandlers = explode('@', $controllerHandlers);
        // controller class
        $controllerClass = $this->controllerContains . $explodeHandlers[0];
        // Method name
        $classMethod = $explodeHandlers[1];
        // create controller instance
        $controllerClass = $container->make($controllerClass);
        // call the desired controller with method and parametrs
        call_user_func_array(array($controllerClass, $classMethod), $paramsHandlers);
    }

    /**
     * Inlclude routes and calling necessary controller
     *
     * @param \Illuminate\Container\Containe $container
     * @return void
     */
    public function runRouter(Container $container) : void
    {
        $dispatcher = \FastRoute\simpleDispatcher(function(\FastRoute\RouteCollector $router) {
            $this->includeRoutes($router);
        });
        // call route
        $this->setParams($dispatcher)->callHandler($container);
    }
}