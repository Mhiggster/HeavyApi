<?php
namespace Pool;

use Pool\Jobs\CachingData;
use Pool\Jobs\ExecuteMessage;

class CronTask
{
    private $actions = [];

    public function __construct(ExecuteMessage $executeMessage, CachingData $cachingData)
    {
        $this->actions[] = $executeMessage->setMessage('GET MOVIES');
        $this->actions[] = $cachingData;
    }

    public function runTasks()
    {
        foreach($this->actions as $action)
        {
            $action->runExecute();
        }
    }
}