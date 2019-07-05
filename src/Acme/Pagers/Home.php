<?php
namespace Pool\Acme\Pagers;

use Pool\Acme\Log;
use Pool\Contracts\Cache;
class Home
{
    use Log;

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
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    private function getData()
    {
        $this->cache->get('movies');
        $this->data = $this->cache->get('movies');
        if(is_null($this->data)) $this->data = \json_encode([]);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function main()
    {
        try {
            if( !file_exists($this->path) ) {
                throw new \Exception('This file ' . $this->path . ' does not exists');
            }
            $this->getData();
        } catch (\Throwable $th) {
            // Write log
            $this->log->warning('Error From Show.php : ' . $th->getMessage(), [
                'options' => $th,
            ]);

            $this->path = __DIR__ . '/../../404.php';
            http_response_code (404);
        }

        require $this->path;
    }
}