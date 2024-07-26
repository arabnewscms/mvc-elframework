<?php

namespace Iliuminates;

use Iliuminates\Router\Route;
use App\Core;
use Iliuminates\Router\Segment;

class Application
{
    protected $router;

    /**
     * to start mvc app
     * @return void
     */
    public function start()
    {
        $this->router  = new Route;

        if(Segment::get(0) == 'api') {
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
        $this->router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
    }


    /**
     * @return void
     */
    public function webRoute()
    {
       
        foreach(Core::$globalWeb as $global) {
            new $global();
        }
        include route_path('web.php');
    }

    
    public function apiRoute()
    {
        foreach(Core::$globalApi as $global) {
            new $global();
        }
        include route_path('api.php');
    }
 


}
