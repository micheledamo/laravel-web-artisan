<?php
return [

    /*
     |--------------------------------------------------------------------------
     | Laravel Web Artisan Settings
     |--------------------------------------------------------------------------
     |
     | Laravel Web Artisan is disabled by default.
     | You can override the value by setting enable to true or false.
     |
     | ATTENTION: Using this package can cause damage to your website.
     |            Use this package only if you are aware of what you are doing.
     |
     */

    'enabled' => env('WEBARTISAN_ENABLED', false),

    /*
     |--------------------------------------------------------------------------
     | Laravel Web Artisan route prefix
     |--------------------------------------------------------------------------
     |
     | Sometimes you want to set route prefix to be used by Laravel Web Artisan
     | to load its resources from. Usually the need comes from misconfigured web
     | server or from trying to overcome bugs like this:
     | http://trac.nginx.org/nginx/ticket/97
     |
     */
    'route_prefix' => '__webartisan',

    /*
     |--------------------------------------------------------------------------
     | Laravel Web Artisan authentication
     |--------------------------------------------------------------------------
     |
     | By default Laravel Web Artisan needs an authentication before you can run
     | commands into the window terminal.
     |
     | We recommend to always use authentication to prevent commands from being
     | executed by anyone when the window is enabled.
     */

    'use_authentication' => true,

    'auth' => [
        'username' => env('WEBARTISAN_USERNAME'),
        'password' => env('WEBARTISAN_PASSWORD')
    ],

];