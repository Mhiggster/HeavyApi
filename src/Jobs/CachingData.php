<?php
namespace App\Jobs;

use App\Acme\ApiRequest;
use Pool\Jobs\JobsConnectionManage;

class CachingData extends JobsConnectionManage
{
    protected $apiRequest;

    public function __construct(ApiRequest $apiRequest)
    {
        $this->apiRequest = $apiRequest;
    }

    private function execute()
    {

        $this->channel->queue_declare('SendRequestApi', false, false, false, false);

        // научится отпровлять потверждение
        $this->channel->basic_consume('SendRequestApi', '', false, true, false, false, [$this, 'handle']);
        

        while(count($this->channel->callbacks)) {
            $this->channel->wait();
        }

        $this->closeConnection();
    }

    public function handle($msg)
    {
        $this->apiRequest->makeRequest($msg->body);
    }



}