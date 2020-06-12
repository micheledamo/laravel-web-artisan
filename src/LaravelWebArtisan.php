<?php
namespace Micheledamo\LaravelWebArtisan;

use GuzzleHttp;
use Illuminate\Http\Response;

class LaravelWebArtisan
{
    /**
     * The Laravel application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * True when enabled.
     *
     * @var bool
     */
    protected $enabled;

    /**
     * True when use authentication
     *
     * @var
     */
    protected $use_authentication;

    /**
     * True when authenticated.
     *
     * @var
     */
    protected $authenticated;

    /**
     * LaravelWebArtisan constructor.
     *
     * @param null $app
     */
	public function __construct($app = null)
	{
        if (!$app) {
            $app = app();   //Fallback when $app is not given
        }
        $this->app = $app;

        $this->enabled = value($this->app['config']->get('webartisan.enabled'));
        $this->use_authentication = value($this->app['config']->get('webartisan.use_authentication'));
        $this->authenticated = false;
	}

    /**
     * Check if the Web Artisan is enabled
     *
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Check if the Web Artisan is authenticated
     *
     * @return bool
     */
    public function isAuthenticated()
    {
        return $this->authenticated or request()->session()->has('webartisan__authenticated');
    }

    /**
     * Check if the Web Artisan use authentication before run commands
     *
     * @return mixed
     */
    public function useAuthentication()
    {
        return $this->use_authentication;
    }

    /**
     * Render the Web Artisan Window
     *
     * @param Response $response
     */
    public function render(Response $response)
    {
        $content = $response->getContent();
        if (($body = mb_strpos($content, '</body>')) !== false) {
            $response->setContent(mb_substr($content, 0, $body) .
                view('webartisan::window', ['webartisan' => $this]) .
                mb_substr($content, $body));
        }
    }

    /**
     * Set authenticated
     *
     * @param bool $value
     */
    public function setAuthenticated($value = true)
    {
        $this->authenticated = $value;
    }

}