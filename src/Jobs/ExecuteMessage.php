<?php
namespace App\Jobs;

use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Connection\AMQPConnection;


class ExecuteMessage
{
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $connection;

    /**
     * Undocumented variable
     *
     * @var [type]
     */ 
    protected $message;
    
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $channel;

    /**
     * Undocumented function
     */
    public function __construct($message = null)
    {
        $this->connection = new AMQPConnection('localhost', '5672', 'guest', 'guest');
        $this->channel = $this->connection->channel();
        
        $this->message = new AMQPMessage($message);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function runExecute()
    {

        $this->channel->queue_declare('SendRequestApi', false, false, false, false);

        $this->channel->basic_publish($this->message, '', 'SendRequestApi');

        $this->channel->close();
        $this->connection->close();
    }

    
}