<?php

use Pecee\SimpleRouter\SimpleRouter;

require_once "../vendor/autoload.php";
require_once "../views.php";

SimpleRouter::get('/profiles', function(){
    return getProfiles();
});

SimpleRouter::options('/profile/new', function(){
    return optionsInsertProfile();
});

SimpleRouter::post('/profile/new', function(){
    return insertProfile();
});

SimpleRouter::post('/profile/{profileId?}/upload-image', function($profileId){
    return uploadImage($profileId);
});

// Start the routing
SimpleRouter::start();