<?php
namespace Pool\Acme;

use Illuminate\Container\Container;
use Pool\Acme\FrontPage;

abstract class Application
{
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $page;


    public function __construct(FrontPage $frontPage)
    {
        $this->page = $frontPage;
    }

    private function bindingContracts()
    {
        
        $this->container->bind(\Pool\Contracts\Cache::class, \Pool\Acme\Cache\Redis::class);
    }
}