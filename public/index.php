<?php

use Pecee\SimpleRouter\SimpleRouter;

require_once "../vendor/autoload.php";
require_once "../views.php";

SimpleRouter::get('/', function(){
    return getProfiles();
});

SimpleRouter::post('/', function(){
    return insertProfile();
});

// Start the routing
SimpleRouter::start();