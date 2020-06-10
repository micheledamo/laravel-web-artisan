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
     | Laravel Web Artisan route domain
     |--------------------------------------------------------------------------
     |
     | By default DebugBar route served from the same domain that request served.
     | To override default domain, specify it as a non-empty value.
     */
    'route_domain' => null,

];