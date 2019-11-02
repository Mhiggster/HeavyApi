<?php
namespace Pool\Handlers;

use Pool\Acme\Log;
use Pool\Contracts\Cache;

/**
 * Class Home
 *
 * TODO: we need extends Super Class
 *
 * @package Pool\Pages
 */
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
     * Undocumented variable
     *
     * @var string
     */
    private $path;

    /**
     * Undocumented function
     *
     * @param Cache $cache
     * @throws \Exception
     */
    public function __construct(Cache $cache)
    {
        $this->logInit();
        $this->cache = $cache;
        $this->path = __DIR__ . '/../templates/home.php';
    }

    /**
     * Retrieve data from cache
     * If data will be null return the empty json field
     *
     * @return void
     */
    private function setData()
    {
        $this->data = $this->cache->get('movies');
        if (is_null($this->data)) $this->data = \json_encode([]);
    }

    /**
     * Display when http URI will equal /
     *
     * @return void
     */
    public function main() : void
    {
        try {
            $this->checkPath();
            $this->setData();
        } catch (\Throwable $th) {
            $this->logWrite($th);

            $this->path = __DIR__ . '/../404.php';
            http_response_code(404);
        }

        require $this->path; // require file by path
    }

    /**
     * Check file Path
     *
     * @throws \Exception
     */
    private function checkPath() : void
    {
        if (!file_exists($this->path)) {
            throw new \Exception('This file ' . $this->path . ' does not exists');
        }
    }

    private function logWrite($th) : void
    {
        $this->log->warning('Error From Hone.php : ' . $th->getMessage(), [
            'options' => $th,
        ]);
    }
}
