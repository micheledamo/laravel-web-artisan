<?php

namespace Micheledamo\LaravelWebArtisan\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Exception\CommandNotFoundException;

class WebArtisanAuthController extends WebArtisanBaseController
{
    /**
     * The username string
     *
     * @var
     */
    protected $username;

    /**
     * The password string
     *
     * @var
     */
    protected $password;

    /**
     * Authentication
     *
     * @param Request $request
     * @return string
     */
    public function auth(Request $request)
    {
        $this->username = $request->has('username')
            ? $request->get('username')
            : null;

        $this->password = $request->has('password')
            ? $request->get('password')
            : null;

        if($this->username and $this->password) {
            $authenticated = true;
            if($this->username != config('webartisan.auth.username')) $authenticated = false;
            if($this->password != config('webartisan.auth.password')) $authenticated = false;

            if($authenticated) {
                $request->session()->put('webartisan__authenticated', true);
                return $this->prepareResultToHtml("Welcome", 'success');
            }
            else return $this->prepareResultToHtml("Oops, it looks like we don't know each other.", 'error');
        }
        return $this->prepareResultToHtml("Username and Password cannot be empty.", 'error');
    }

    /**
     * Logout
     *
     * @param Request $request
     * @return bool
     */
    public function logout(Request $request)
    {
        $this->webartisan->setAuthenticated(false);
        $request->session()->forget('webartisan__authenticated');
        return $this->prepareResultToHtml("See you soon", 'success');
    }

    /**
     * Convert to HTML
     * and present with type colors
     *
     * @param $string
     * @param $type
     * @return string|string[]
     */
    public function prepareResultToHtml($string, $type)
    {
        $string = str_replace("\n", '<br>',
            str_replace("\r", '<br>',
                str_replace("\t", '&nbsp;&nbsp;&nbsp;&nbsp;',
                    str_replace(" ", '&nbsp;',
                        $string))));

        switch ($type) {
            case "error": { $string = '<span class="webartisan__window__results__error">' . $string . '</span>'; }break;
            case "success": { $string = '<span class="webartisan__window__results__success">' . $string . '</span>'; }break;
        }

        return $string;
    }
}