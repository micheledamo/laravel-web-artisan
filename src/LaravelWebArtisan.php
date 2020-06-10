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
	}

    /**
     * Check if the Web Artisan is enabled
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->enabled;
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
                view('webartisan::window') .
                mb_substr($content, $body));
        }
    }

}