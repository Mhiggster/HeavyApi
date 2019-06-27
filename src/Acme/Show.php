<?php
namespace App\Acme;

use Predis\Client as Cache;
class Show
{

    private $path;

    private $data;

    public function __construct()
    {
        $this->cache = new Cache;
        $this->path = __DIR__ . '/../../movies.php';
    }


    private function getData()
    {
        $this->data = $this->cache->get('movies');
        if(is_null($this->data)) $this->data = [];
    }

    public function render()
    {
        try {
            if( !file_exists($this->path) ) {
                throw new \Exception('This file ' . $this->path . ' does not exists');
            }
            
            
        } catch (\Throwable $th) {
            // write log monolog
            echo $th->getMessage();
            // make redirect or throw 404
            $this->path = __DIR__ . '/../../404.php';
        }

        $this->getData();
        require $this->path;
        
    }
}