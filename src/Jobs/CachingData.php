<?php
namespace App\Jobs;

use PhpAmqpLib\Connection\AMQPConnection;
use App\Acme\ApiRequest;

class CachingData
{
    protected $connection;

    protected $channel;

    protected $apiRequest;

    public function __construct()
    {
        $this->connection = new AMQPConnection('localhost', '5672', 'guest', 'guest');
        $this->channel = $this->connection->channel();
        $this->apiRequest = new ApiRequest;

        $this->execute();
        
    }

    private function execute()
    {

        $this->channel->queue_declare('SendRequestApi', false, false, false, false);

        // научится отпровлять потверждение
        $this->channel->basic_consume('SendRequestApi', '', false, true, false, false, [$this, 'handle']);
        

        while(count($this->channel->callbacks)) {
            $this->channel->wait();
        }


        $this->channel->close();
        $this->connection->close();
    }

    public function handle($msg)
    {
        // write a log
        echo 'make something' . "\n";
        $this->apiRequest->makeRequest($msg->body);
        // and api Request
        echo 'Api requests is done...';
    }



}