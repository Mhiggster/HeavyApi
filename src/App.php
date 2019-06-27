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
        $this->publisher = new ExecuteMessage('GET MOVIES');
        $this->publisher->runExecute();
    }

    public function processJob()
    {
        new CachingData();
    }


    public function clearCache()
    {
        
    }

}