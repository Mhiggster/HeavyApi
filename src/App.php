<?php
namespace App;

use App\Jobs\ExecuteMessage;

use App\Acme\Show;
use App\Jobs\CachingData;

class App
{
    protected $publisher;

    protected $show;

    public function __construct()
    {
        $this->show = new Show();
    }

    public function init()
    {
        $this->show->render();
    }

    public function sendJob()
    {
        for ($i=1; $i <= 3; $i++) {
            $this->publisher = new ExecuteMessage($i);
            $this->publisher->runExecute();
        }
    }

    public function processJob()
    {
        new CachingData();
    }


    public function clearCache()
    {
        
    }

}