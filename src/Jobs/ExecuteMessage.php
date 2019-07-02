<?php
namespace Pool\Jobs;

use PhpAmqpLib\Message\AMQPMessage;
use Pool\Jobs\JobsConnectionManage;

class ExecuteMessage extends JobsConnectionManage
{
    /**
     * Undocumented variable
     *
     * @var [type]
     */ 
    private $message;

    /**
     * Undocumented function
     *
     * @param string $message
     */
    public function __construct()
    {
        parent::__construct();
        
    }

    public function setMessage(string $message = '')
    {
        $this->message = new AMQPMessage($message);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function runExecute()
    {
        // make connection
        // make request
        // close connection
        $this->channel->queue_declare('SendRequestApi', false, false, false, false);

        $this->channel->basic_publish($this->message, '', 'SendRequestApi');

        $this->closeConnection();
    }

    
}