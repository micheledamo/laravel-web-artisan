<?php

namespace Micheledamo\LaravelWebArtisan\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
     * @param $request
     * @param Closure $next
     * @return Response|mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if ($response instanceof Response and $this->webartisan->isEnabled() and $request->url() != asset(config('webartisan.route_prefix').'/run')) {
            try {
                $response->getContent();
            }
            catch (\ErrorException $e) {
                return $response;
            }

            if(!$this->webartisan->useAuthentication()
                or ($this->webartisan->useAuthentication()
                    and $request->session()->has('webartisan__authenticated'))) {

                $this->webartisan->setAuthenticated();
            }

            $this->webartisan->render($response);
        }
        return $response;
    }
}