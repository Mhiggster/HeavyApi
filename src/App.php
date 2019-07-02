<?php
namespace Pool;

use Pool\Acme\FrontPage;
use Pool\Acme\Application;
use Pool\Jobs\CachingData;
use Pool\Jobs\ExecuteMessage;
use Illuminate\Container\Container;

class App extends Application
{
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $publisher;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $container;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $page;

    /**
     * Undocumented function
     *
     * @param Container $container
     * @param FrontPage $frontPage
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function init()
    {
        $this->bindingContracts();
        $this->setInstances();
        $this->page->render();

    }

    

    private function bindingContracts()
    {
        $this->container->bind(\Pool\Contracts\Cache::class, \Pool\Acme\Cache\Redis::class);
    }


    private function setInstances()
    {
        $this->page = $this->container->make(FrontPage::class);
    }

}