<?php
namespace Pool;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Container\Container;
use Pool\Acme\Application;
use Pool\Acme\CronTask;
use Pool\Acme\Router;

/**
 * Class App
 * @package Pool
 */
class App extends Application
{
    /**
     * Instance of Laravel Ioc Container
     *
     * @var Container
     */
    private $container;

    /**
     * Cron task Instance
     *
     * @var [type]
     */
    private $cron;

    /**
     * FastRouter Instance
     *
     * @var \Pool\Acme\Router
     */
    private $router;

    /**
     * Environment request
     *
     * If we run our Application from bash terminal then
     * Our request will be differ from Http Request
     *
     * @var [type]
     */
    private $envRequest;

    /**
     * Init Our Application Ioc Container
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->envRequest = $_SERVER['SERVER_NAME'];
    }

    /**
     * Bootstrapping our application
     *
     * Firstly: We will run our contracts to render ever app interface
     * Secondly: Creating Base Application Instance to Help working our app
     * Third: Choose The correct Request
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function init()
    {
        $this->bindingContracts();
        $this->setAppInstances();
        $this->selectRequest();
    }

    /**
     * Bind the Interface with Class
     *
     * @return void
     */
    private function bindingContracts()
    {
        $this->container->bind(\Pool\Contracts\Cache::class, \Pool\Acme\Cache\Redis::class);
        $this->container->bind(\Pool\Contracts\HeavyRequest::class, \Pool\Acme\RequestTypes\ExampleRequest::class);
        // $this->container->bind(\Psr\Http\Message\RequestInterface::class, \GuzzleHttp\Psr7\Request::class);
    }

    /**
     * Put base application classes to Ioc container
     *
     * @return void
     * @throws BindingResolutionException
     */
    private function setAppInstances()
    {
        $this->router = $this->container->make(Router::class);
        $this->cron   = $this->container->make(CronTask::class);
    }

    /**
     * If our request coming from HTTP request
     * We run our application using FastRouter and Simple MVC pattern
     * Or If request coming from bash we run cronTask's action
     *
     * In fact, the launch of our application starts from here.
     *
     * @return mixed
     */
    private function selectRequest()
    {
        if(isset($this->envRequest)) {
            return $this->buildRouter();
        }
        $this->cron->runTasks();
    }

    /**
     * Building your own router
     * It's Like director for builder design pattern
     *
     * @return void
     */
    private function buildRouter()
    {
        $this->container->call([$this->router, 'runRouter'], ['container' => $this->container]);
    }
}
