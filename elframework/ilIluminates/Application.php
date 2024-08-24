<?php

namespace Iliuminates;

use Iliuminates\Router\Route;
use App\Core;
use Iliuminates\Middleware\CSRFToken;
use Iliuminates\Router\Segment;
use Iliuminates\Sessions\Session;

class Application
{
    protected $router;
    protected $framework_setting;

    /**
     * to start mvc app
     * @return void
     */
    public function start()
    {
        $this->router  = new Route;
        $this->framework_setting = new FrameworkSettings;

        $this->framework_setting::setTimeZone();

        if (Segment::get(0) == 'api') {
            $this->apiRoute();
        } else {
            $this->webRoute();
        }
    }

    /**
     * to dispatch many class
     * @return void
     */
    public function __destruct()
    {
        $this->router->dispatch(parse_url($_SERVER['REQUEST_URI'])['path'], $_SERVER['REQUEST_METHOD']);
    }


    /**
     * @return void
     */
    public function webRoute()
    {


        foreach (Core::$globalWeb as $global) {
            new $global();
        }

        $this->createCSRF();
        $this->framework_setting::setLocale(config('app.locale'));
        include route_path('web.php');
    }

    public function createCSRF()
    {
        if (!Session::has('csrf_token')) {
            $csrf = CSRFToken::generateCSRFToken();
            Session::make('csrf_token', $csrf);
        }
    }

    public function apiRoute()
    {
        foreach (Core::$globalApi as $global) {
            new $global();
        }
        include route_path('api.php');
    }
}
