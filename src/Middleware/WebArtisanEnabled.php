<?php

namespace Micheledamo\LaravelWebArtisan\Middleware;

use Closure;
use Illuminate\Http\Request;
use Micheledamo\LaravelWebArtisan\LaravelWebArtisan;

class WebArtisanEnabled
{
    /**
     * The WebArtisan instance
     *
     * @var LaravelWebArtisan
     */
    protected $webartisan;

    /**
     * Create a new middleware instance.
     *
     * @param  LaravelWebArtisan $webartisan
     */
    public function __construct(LaravelWebArtisan $webartisan)
    {
        $this->webartisan = $webartisan;
    }

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if ($this->webartisan->isEnabled() and $request->url() != asset(config('webartisan.route_prefix').'/run')) {
            try {
                $response->getContent();
            }
            catch (\ErrorException $e) {
                return $response;
            }
            $this->webartisan->render($response);
        }
        return $response;
    }
}