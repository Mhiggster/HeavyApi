<?php
namespace Pool;

use Pool\Jobs\CachingData;
use Pool\Jobs\ExecuteMessage;

class CronTask
{
    /**
     * Cron actions container
     *
     * @var array
     */
    private $actions = [];

    /**
     * Init actions
     *
     * @param \Pool\Jobs\ExecuteMessage $executeMessage
     * @param \Pool\Jobs\CachingData $cachingData
     * @return void
     */
    public function __construct(ExecuteMessage $executeMessage, CachingData $cachingData) : void
    {
        $this->actions[] = $executeMessage->setMessage('GET MOVIES');
        $this->actions[] = $cachingData;
    }

    /**
     * Run tasks polymorphically
     *
     * @return void
     */
    public function runTasks() : void
    {
        foreach($this->actions as $action)
        {
            $action->runExecute();
        }
    }
}