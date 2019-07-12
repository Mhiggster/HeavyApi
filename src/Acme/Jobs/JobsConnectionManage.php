<?php
namespace Pool\Acme\Jobs;

use PhpAmqpLib\Connection\AMQPConnection;

abstract class JobsConnectionManage
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
    protected $channel;

    /**
     * Undocumented function
     */
    public function __construct()
    {
        $this->connection = new AMQPConnection('localhost', '5672', 'guest', 'guest');
        $this->channel = $this->connection->channel();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function closeConnection()
    {
        $this->channel->close();
        $this->connection->close();
    }
}