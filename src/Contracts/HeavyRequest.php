<?php
namespace Pool\Contracts;

interface HeavyRequest
{
    /**
     * @param string $message
     */
    public function makeRequest(string $message) : void;
}
