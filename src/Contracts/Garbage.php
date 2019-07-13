<?php
namespace Pool\Contracts;

interface Garbage
{
    public function makeRequest(string $message) : void;
}