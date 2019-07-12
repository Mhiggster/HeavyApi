<?php
namespace Pool\Acme\Jobs;

use Pool\Contracts\Garbage;
use Pool\Acme\Jobs\JobsConnectionManage;

class CachingData extends JobsConnectionManage
{
    protected $garbage;

    public function __construct(Garbage $garbage)
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
    public function runExecute()
    {
        $this->makeRequest();
        $this->closeConnection();
    }

    public function handle($msg)
    {
        echo 'Hanle starts...' . "\n";
        $this->garbage->makeRequest($msg->body);
        echo 'work is done!';
    }
}