<?php
namespace Pool\Acme\Cache;

use Predis\Client;
use Pool\Contracts\Cache;

class Redis implements Cache
{
    private $client;

    /**
     * Undocumented function
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Undocumented function
     *
     * @param string $key
     * @param string $data
     * @return void
     */
    public function set(string $key, string $data) : void
    {
        $this->client->set($key, $data);
    }

    /**
     * Undocumented function
     *
     * @param string $key
     * @return mixed
     */
    public function get(string $key) : ?string
    {
        return $this->client->get($key);
    }

    /**
     * Undocumented function
     *
     * @param string $key
     * @return void
     */
    public function clear(string $key) : void
    {
        echo 'clear cache';
    }

}