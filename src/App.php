<?php
namespace App;

use App\Jobs\ExecuteMessage;
use Predis\Client as Cache;
 
class App
{
    protected $publisher;

    public function __construct()
    {
        
    }

    public function init()
    {
        // Это ерунда должа отработать лишь раз
        $redis = new Cache();
        if(is_null($redis->get('red'))) {
            for ($i=1; $i <= 3; $i++) {
                $this->publisher = new ExecuteMessage($i);
                $this->publisher->runExecute();
            }
        }
        // 
        
    }


    public function show()
    {
        $redis = new Cache();
        $set = $redis->get('movies');
        $red = $redis->get('red');

        if( isset( $red )) {
            echo $redis->get('movies');
        } else {
            echo 'No found';
        }
    }
}