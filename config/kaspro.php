<?php

if(env('APP_STATE') == 'dev') {
    return [
        'APP_STATE' => 'dev'
    ];
}
elseif(env('APP_STATE') == 'prod') {
    return [
        'APP_STATE' => 'prod'
    ];
}
