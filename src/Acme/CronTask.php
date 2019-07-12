<?php
namespace Pool\Acme;

use Pool\Acme\Jobs\CachingData;
use Pool\Acme\Jobs\ExecuteMessage;

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
     * @param \Pool\Acme\Jobs\ExecuteMessage $executeMessage
     * @param \Pool\Acme\Jobs\CachingData $cachingData
     * @return void
     */
    public function __construct(ExecuteMessage $executeMessage, CachingData $cachingData)
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