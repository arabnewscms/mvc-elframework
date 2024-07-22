<?php

namespace Iliuminates\Router;

class Router
{
    protected static $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'PATCH' => [],
        'DELETE' => [],
    ];

    private static $public;

    /**
     * @return string
     */
    public static function public_path($bind = 'public'): string
    {
        static::$public = $bind;
        return static::$public;
    }

    /**
     * @param string $method
     * @param string $route
     * @param mixed $controller
     * @param mixed $action
     * @param array $middleware
     *
     * @return [type]
     */
    public static function add(string $method, string $route, $controller, $action = null, array $middleware = [])
    {
        $route = ltrim($route, '/');
        self::$routes[$method][$route]  = compact('controller', 'action', 'middleware');
    }

    /**
     * @return static $routes
     */
    public function routes()
    {
        return static::$routes;
    }


    /**
     * @param mixed $uri
     * @param mixed $method
     *
     * @return void
     */
    public static function dispatch($uri, $method)
    {
        $uri = ltrim($uri, '/' . static::public_path() . '/');
        foreach (static::$routes[$method] as $key => $val) {
            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_]+)', $key);
            $pattern = "#^$pattern$#";
            if (preg_match($pattern, $uri, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                $controller = $val['controller'];
                if (is_object($controller)) {
                    echo $controller(...$params);
                    return '';
                } else {
                    $action = $val['action'];
                    $middleware = $val['middleware'];
                   
                    echo call_user_func_array([new $controller, $action], $params);
                    return '';
                }
            }
        }

        throw new \Exception(' this route ' . $uri . ' not found');
    }
}
