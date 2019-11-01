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
     * @return void
     */
    public function set(string $key, string $data) : void;

    /**
     * Undocumented function
     *
     * @return void
     */
    public function get(string $key) : ?string;

    /**
     * Undocumented function
     *
     * @return void
     */
    public function clear(string $key) : void;
}
