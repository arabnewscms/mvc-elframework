<?php
namespace Iliuminates\Router\Traits;

use App\Http\Controllers\HomeController;
use App\Http\Middleware\SimpleMiddleware;

trait Methods
{

    /**
     * @param string $route
     * @param mixed $controller
     * @param mixed $action
     * @param array $middleware
     *
     * @return void
     */
    public static function get(string $route, $controller, $action=null, array $middleware = [])
    {
        parent::add('GET', $route, $controller, $action, $middleware);
    }


    /**
     * @param string $route
     * @param mixed $controller
     * @param mixed $action
     * @param array $middleware
     *
     * @return void
     */
    public static function post(string $route, $controller, $action, array $middleware = []):void
    {
        parent::add('POST', $route, $controller, $action, $middleware);
    }

    /**
     * @param string $route
     * @param mixed $controller
     * @param mixed $action
     * @param array $middleware
     *
     * @return void
     */
    public static function put(string $route, $controller, $action, array $middleware = []):void
    {
        parent::add('PUT', $route, $controller, $action, $middleware);
    }

    /**
     * @param string $route
     * @param mixed $controller
     * @param mixed $action
     * @param array $middleware
     *
     * @return void
     */
    public static function patch(string $route, $controller, $action, array $middleware = []):void
    {
        parent::add('PATCH', $route, $controller, $action, $middleware);
    }

    /**
     * @param string $route
     * @param mixed $controller
     * @param mixed $action
     * @param array $middleware
     *
     * @return void
     */
    public static function delete(string $route, $controller, $action, array $middleware = []):void
    {
        parent::add('delete', $route, $controller, $action, $middleware);
    }

}
