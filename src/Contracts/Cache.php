<?php
namespace Pool\Contracts;

interface Cache
{
    /**
     * Undocumented function
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