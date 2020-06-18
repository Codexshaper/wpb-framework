<?php

use CodexShaper\WP\Support\Facades\Route;


Route::get('test', function(){
    echo view('welcome');
    die();
});


