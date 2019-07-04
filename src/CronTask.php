<?php
namespace Pool;

use Pool\Jobs\CachingData;
use Pool\Jobs\ExecuteMessage;

class CronTask
{
    /**
     * Undocumented variable
     *
     * @var array
     */
    private $actions = [];

    /**
     * Undocumented function
     *
     * @param ExecuteMessage $executeMessage
     * @param CachingData $cachingData
     */
    public function __construct(ExecuteMessage $executeMessage, CachingData $cachingData)
    {
        $this->actions[] = $executeMessage->setMessage('GET MOVIES');
        $this->actions[] = $cachingData;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function runTasks()
    {
        foreach($this->actions as $action)
        {
            $action->runExecute();
        }
    }
}