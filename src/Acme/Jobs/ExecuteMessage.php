<?php
namespace Pool\Acme\Jobs;

use PhpAmqpLib\Message\AMQPMessage;
use Pool\Acme\Jobs\JobsConnectionManage;

class ExecuteMessage extends JobsConnectionManage
{
    /**
     * Messages Line
     *
     * @var string
     */ 
    private $message;

    /**
     * Make connection
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Setting message
     *
     * @param string $message
     * @return void
     */
    public function setMessage(string $message = '') : ExecuteMessage
    {
        $this->message = new AMQPMessage($message);
        return $this;
    }

    /**
     * Making Request
     *
     * @return void
     */
    private function makeRequest()
    {
        $this->channel->queue_declare('SendRequestApi', false, false, false, false);
        $this->channel->basic_publish($this->message, '', 'SendRequestApi');
    }

    /**
     * Making Request and Close the connection
     *
     * @return void
     */
    public function runExecute()
    {
        $this->makeRequest();
        $this->closeConnection();
    }
}