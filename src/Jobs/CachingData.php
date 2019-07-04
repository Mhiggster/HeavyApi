<?php
namespace Pool\Jobs;

use Pool\Acme\ApiRequest;
use Pool\Jobs\JobsConnectionManage;

class CachingData extends JobsConnectionManage
{
    protected $garbage;

    public function __construct(ApiRequest $garbage)
    {
        parent::__construct();
        $this->garbage = $garbage;
    }

    private function makeRequest() {
        $this->channel->queue_declare('SendRequestApi', false, false, false, false);
        // научится отпровлять потверждение
        $this->channel->basic_consume('SendRequestApi', '', false, true, false, false, [$this, 'handle']);

        while(count($this->channel->callbacks)) {
            $this->channel->wait();
        }
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    private function runExecute()
    {
        $this->makeRequest();
        $this->closeConnection();
    }

    public function handle($msg)
    {
        $this->garbage->makeRequest($msg->body);
    }
}