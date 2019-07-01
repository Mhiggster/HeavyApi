<?php
namespace Pool;

use Pool\Acme\FrontPage;
use Pool\Acme\Application;
use Pool\Jobs\CachingData;
use Pool\Jobs\ExecuteMessage;

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
    protected $page;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $container;

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
    }

    public function init()
    {
        $this->page->render();
    }

    

    private function bindingContracts()
    {

    }

    // public function clearCache()
    // {
        
    // }


    public function sendJob()
    {
        $this->publisher = new ExecuteMessage('GET MOVIES');
        $this->publisher->runExecute();
    }

    public function processJob()
    {
        new CachingData();
    }

}