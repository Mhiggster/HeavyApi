<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\App;

(new App)->sendJob();
(new App)->processJob();