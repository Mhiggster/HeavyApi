<?php
namespace Pool\Acme\Jobs;

use Pool\Contracts\Garbage;
use Pool\Acme\Jobs\JobsConnectionManage;

class CachingData extends JobsConnectionManage
{
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $garbage;

    /**
     * Undocumented function
     *
     * @param Garbage $garbage
     */
    public function __construct(Garbage $garbage)
    {
        parent::__construct();
        $this->garbage = $garbage;
    }

    /**
     * Undocumented function
     *
     * @return void
     * @throws \ErrorException
     */
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
     * @throws \ErrorException
     */
    public function runExecute()
    {
        $this->makeRequest();
        $this->closeConnection();
    }

    /**
     * Undocumented function
     *
     * @param [type] $msg
     * @return void
     */
    public function handle($msg)
    {
        echo 'Hanle starts...' . "\n";
        $this->garbage->makeRequest($msg->body);
        echo 'work is done!';
    }
}
