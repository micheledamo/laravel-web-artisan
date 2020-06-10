<?php

namespace Micheledamo\LaravelWebArtisan\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Micheledamo\LaravelWebArtisan\LaravelWebArtisan;


if (class_exists('Illuminate\Routing\Controller')) {

    class WebArtisanBaseController extends Controller
    {
        protected $webartisan;

        public function __construct(Request $request, LaravelWebArtisan $webartisan)
        {
            $this->webartisan = $webartisan;
        }
    }

} else {

    class WebArtisanBaseController
    {
        protected $webartisan;

        public function __construct(Request $request, LaravelWebArtisan $webartisan)
        {
            $this->webartisan = $webartisan;
        }
    }
}