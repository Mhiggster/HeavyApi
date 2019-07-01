<?php
namespace Pool\Acme;

use Pool\Acme\Log;
use Pool\Contracts\Cache;

class FrontPage
{
    use Log;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $path;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $data;

    /**
     * Undocumented function
     */
    public function __construct(Cache $cache)
    {
        $this->logInit();
        $this->cache = $cache;
        // $this->path = __DIR__ . '/../../movies.php';
    }


    private function getData()
    {
        $this->data = $this->cache->get('movies');
        if(is_null($this->data)) $this->data = [];
    }

    public function render()
    {
        // try {
        //     if( !file_exists($this->path) ) {
        //         throw new \Exception('This file ' . $this->path . ' does not exists');
        //     }
            
            
        // } catch (\Throwable $th) {
        //     $this->log->warning('Error From Show.php : ' . $th->getMessage(), [
        //         'options' => $th,
        //     ]);
        //     $th->getMessage();
        //     // make redirect or throw 404
        //     $this->path = __DIR__ . '/../../404.php';
        // }
        
        
        // $this->getData();
        // require $this->path;
        
    }
}