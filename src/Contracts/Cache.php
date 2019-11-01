<?php
namespace Pool\Contracts;

/**
 * Interface Cache
 * Main interface you can implement own services for cache
 *
 * @package Pool\Contracts
 */
interface Cache
{
    /**
     * If you want to put some data to cache you should use given method
     *
     * @param string $key
     * @param string $data
     * @return void
     */
    public function set(string $key, string $data) : void;

    /**
     * Retrieve our data from cache
     *
     * @param string $key
     * @return string|null
     */
    public function get(string $key) : ?string;

    /**
     * Clear every data from cache
     *
     * @param string $key
     * @return void
     */
    public function clear(string $key) : void;
}
