<?php

namespace Micheledamo\LaravelWebArtisan\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Exception\CommandNotFoundException;

class WebArtisanCommandController extends WebArtisanBaseController
{
    /**
     * The command string
     *
     * @var
     */
    protected $command;

    /**
     * Run the command
     *
     * @param Request $request
     * @return string
     */
    public function run(Request $request)
    {
        $this->command = $request->has('command')
            ? $request->get('command')
            : null;

        if($this->command) {
            $commandPrepared = $this->prepareCommand($this->command);
            if(!config('webartisan.use_authentication')
                or (config('webartisan.use_authentication') and $this->webartisan->isAuthenticated())) {
                    try {
                        Artisan::call($commandPrepared);
                    }
                    catch(\Exception $e) {
                        return $this->prepareResultToHtml($e->getMessage(), 'error');
                    }
            }
            else {
                return $this->prepareResultToHtml('Please, authenticate yourself before to start using Web Artisan.', 'error');
            }
            return $this->prepareResultToHtml(Artisan::output(), 'success');
        }
    }

    /**
     * Prepare command for Artisan
     *
     * @param $command
     * @return mixed
     */
    public function prepareCommand($command)
    {
        $command = $this->clearPhpArtisan($command);
        return $command;
    }

    /**
     * Remove "php artisan" if present
     *
     * @param $command
     * @return string|string[]
     */
    public function clearPhpArtisan($command)
    {
        return str_replace("php artisan ", "", $command);
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