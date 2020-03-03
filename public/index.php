<?php

use Pecee\SimpleRouter\SimpleRouter;

require_once "../vendor/autoload.php";

SimpleRouter::get('/', function() {
    return 'Hello world';
});

// Start the routing
SimpleRouter::start();