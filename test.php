<?php
require __DIR__ . '/vendor/autoload.php';
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
use App\Acme\ApiRequest;


(new ApiRequest)->makeRequest();