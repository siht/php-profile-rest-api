<?php

use Pecee\SimpleRouter\SimpleRouter;

require_once "../vendor/autoload.php";
require_once "../views.php";

SimpleRouter::get('/profiles', function(){
    return getProfiles();
});

SimpleRouter::post('/profile/new', function(){
    return insertProfile();
});

// Start the routing
SimpleRouter::start();