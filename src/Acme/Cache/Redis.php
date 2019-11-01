<?php
namespace Pool\Acme\Cache;

use Predis\Client;
use Pool\Contracts\Cache;

class Redis implements Cache
{
    private $client;

    /**
     * Receiving Redis client
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Put data to the redis using redis setter
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
     * Retrieve data from redis cache
     *
     * @param string $key
     * @return mixed
     */
    public function get(string $key) : ?string
    {
        return $this->client->get($key);
    }

    /**
     * Flushing ever data from redis database
     *
     * @param string $key
     * @return void
     */
    public function clear(string $key) : void
    {
        $this->client->flushAll();
    }

}
