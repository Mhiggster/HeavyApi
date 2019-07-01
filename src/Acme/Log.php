<?php
namespace Pool\Acme;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

trait Log
{
    protected $log;

    protected $logPath;

    protected function logInit()
    {
        $this->logPath = __DIR__ . '/../../app.log';
        $this->log = new Logger('name');
        $this->log->pushHandler(new StreamHandler($this->logPath, Logger::WARNING));
    }
}