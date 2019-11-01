<?php
namespace Pool\Contracts;

interface HeavyRequest
{
    /**
     * @param string $message
     * @return void
     */
    public function makeRequest(string $message) : void;
}
