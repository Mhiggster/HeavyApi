<?php
namespace Pool;

use Pool\CronTask;
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
     * Undocumented variable
     *
     * @var [type]
     */
    private $cron;

    /**
     * Undocumented function
     *
     * @param Container $container
     * @param FrontPage $frontPage
     */
    public function __construct(Container $container)
    {
        $this->container = $container;

        $this->bindingContracts();
        $this->setInstances();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function init()
    {
        $this->page->render();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function taskRunner()
    {
        $this->cron->runTasks();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    private function bindingContracts()
    {
        $this->container->bind(\Pool\Contracts\Cache::class, \Pool\Acme\Cache\Redis::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    private function setInstances()
    {
        $this->page = $this->container->make(FrontPage::class);
        $this->cron = $this->container->make(CronTask::class);
    }

}