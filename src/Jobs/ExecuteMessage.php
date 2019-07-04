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
     * Make connection
     *
     * @param string $message
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Undocumented function
     *
     * @param string $message
     * @return void
     */
    public function setMessage(string $message = '')
    {
        $this->message = new AMQPMessage($message);
        return $this;
    }

    private function makeRequest()
    {
        // make request
        $this->channel->queue_declare('SendRequestApi', false, false, false, false);

        $this->channel->basic_publish($this->message, '', 'SendRequestApi');
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

    
}