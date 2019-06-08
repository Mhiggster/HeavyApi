<?php
namespace App\Jobs;

use PhpAmqpLib\Connection\AMQPConnection;

class CachingData
{
    protected $connection;

    protected $channel;

    public function __construct()
    {
        $this->connection = new AMQPConnection('localhost', '5672', 'guest', 'guest');
        $this->channel = $this->connection->channel();

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
        echo 'Do something nice' . "\n";
        sleep(4);
        echo 'our job is ended' . "\n";
        echo 'our message is: ' . $msg->body . "\n";
    }



}