<?php

require __DIR__ . '/vendor/autoload.php';

use App\Jobs\ExecuteMessage;

for ($i=0; $i < 5; $i++) { 
    (new ExecuteMessage)->runExecute();
}