<?php

$router->get('test', function(){
    echo wpb_view('welcome');
    die();
});


