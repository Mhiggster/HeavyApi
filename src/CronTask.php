<?php
namespace Pool;

use Pool\Jobs\CachingData;
use Pool\Jobs\ExecuteMessage;

class CrontTask
{
    private $publisher;
    private $cachingData;

    public function sendJob()
    {
        $this->publisher = new ExecuteMessage('GET MOVIES');
        $this->publisher->runExecute();
    }

    // Поробывать через container->call
    public function processJob(CachingData $cachingData)
    {
        $this->cachingData = $cachingData;
    }
}