<?php

require __DIR__ . '/vendor/autoload.php';

use App\Jobs\ExecuteMessage;


(new ExecuteMessage)->runExecute();