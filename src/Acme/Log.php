<?php
namespace Pool\Acme;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

trait Log
{
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $log;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $logPath;

    /**
     * Undocumented function
     *
     * @return void
     * @throws \Exception
     */
    protected function logInit()
    {
        $this->logPath = __DIR__  . '/../../app.log';
        $this->log = new Logger('name');
        $this->log->pushHandler(new StreamHandler($this->logPath, Logger::WARNING));
    }
}
