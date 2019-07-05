<?php
namespace Pool\Acme;

use Illuminate\Container\Container;

class Router
{
    /**
     * uri запроса
     * @var string
     */
    protected $uri;
    
    /**
     * тип метода
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
     * Router constructor.
     */
    public function __construct()
    {
        $this->uri        = $_SERVER['REQUEST_URI'];
        $this->httpMethod = $_SERVER['REQUEST_METHOD'];

        $this->routeActions = [];
    }
    /**
     * @param $router
     */
    public function includeRoutes($router)
    {
        try {
            require __DIR__ . '/../routes.php';
        } catch (\Throwable $th) {
            //throw $th;
        }
        
    }

    private function trimedUri()
    {
        if (false !== $pos = strpos($this->uri, '?')) {
            $this->uri = substr($this->uri, 0, $pos);
        }
        $this->uri = rawurldecode($this->uri);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    private function dispatchingHandlers($dispatcher)
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
     * Получаем список параметров
     * Либо коды ошибок такие как 404 | 405
     * 
     * @param $dispatcher
     * @return array
     */
    public function setParams($dispatcher)
    {
        $this->trimedUri();
        $this->dispatchingHandlers($dispatcher);
        return $this;
        
    }
    public function callHandler($container)
    {
        // Получаем контроллер и метод
        $controllerHandlers = reset($this->routeActions);
        // Получаем параметры
        $paramsHandlers = end($this->routeActions);
        // Делим контроллер
        $explodeHandlers = explode('@', $controllerHandlers);
        // Класс Контроллера
        $controllerClass = '\Pool\Acme\Pagers\\' . $explodeHandlers[0];
        // Имя метода
        $classMethod = $explodeHandlers[1];
        // Создаем экземпляр обьекта
        $controllerClass = $container->make($controllerClass);
        // Вызываем нужный контроллер с нужным методом и параметрами
        call_user_func_array(array($controllerClass, $classMethod), $paramsHandlers);
    }
    // Rename this Action
    public function runRouter(Container $container)
    {
        // Подключаем Роуты
        $dispatcher = \FastRoute\simpleDispatcher(function(\FastRoute\RouteCollector $router) {
            $this->includeRoutes($router);
        });
        // Вызываем нужный роут
        $this->setParams($dispatcher)->callHandler($container);
    }
}