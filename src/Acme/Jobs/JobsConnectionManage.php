<?php
namespace Pool\Acme\Jobs;

use PhpAmqpLib\Connection\AMQPStreamConnection;

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
        $this->connection = new AMQPStreamConnection('rabbitmq', '5672', 'guest', 'guest');
        $this->channel = $this->connection->channel();
    }

    /**
     * Undocumented function
     *
     * @return void
     * @throws \Exception
     */
    public function closeConnection()
    {
        $this->channel->close();
        $this->connection->close();
    }
}
