<?php

namespace Iliuminates\Router;

use Iliuminates\Middleware\Middleware;

class Router
{
    protected static $routes = [];
    protected static $groupAttributes = [];

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
        $route  = self::applyGroupPrefix($route);
        $middleware = array_merge(static::getGroupMiddleware(), $middleware);
        self::$routes[] = [
            'method' => $method,
            'uri' => ltrim($route, '/'),
            'controller' => $controller,
            'action' => $action,
            'middleware' => $middleware
        ];
    
    }

    public static function group($attributes, $callback)
    {
        $previousGroupAttribute  = static::$groupAttributes;
        static::$groupAttributes = array_merge(static::$groupAttributes, $attributes);
        call_user_func($callback, new self);
        static::$groupAttributes = $previousGroupAttribute;
    }

    protected static function applyGroupPrefix($route)
    {
        if (isset(static::$groupAttributes['prefix'])) {
            $full_route = rtrim(static::$groupAttributes['prefix'], '/') . '/' . ltrim($route, '/');
            return rtrim(ltrim($full_route, '/'), '/');
        } else {
            return $route;
        }
    }

    protected static function getGroupMiddleware()
    {
        return static::$groupAttributes['middleware'] ?? [];
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
        $uri = empty($uri)?'/':$uri;
        //var_dump($uri);
       // echo "<pre>";
        //var_dump(static::$routes);

        foreach (static::$routes as $route) {
            if ($route['method'] == $method) {
                

                $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_]+)', $route['uri']);
                $pattern = "#^$pattern$#";
                if (preg_match($pattern, $uri, $matches)) {
                    $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                    $controller = $route['controller'];
                    if (is_object($controller)) {

                        $route['middleware'] = $route['action'];
                        $middlewareStack = $route['middleware'];

                        // Prepare Data and add anonymous function to $next variable
                        $next = function ($request) use ($controller, $params) {
                            return  $controller(...$params);
                        };
                         
                        // Proccessing Middleware if using Anonymous Functions
                        $next = Middleware::handleMiddleware($middlewareStack, $next);

                        echo $next($uri);
                    } else {
                        $action = $route['action'];
                        $middlewareStack = $route['middleware'];

                        // Prepare Data and add anonymous function to $next variable
                        $next = function ($request) use ($controller, $action, $params) {
                            return call_user_func_array([new $controller, $action], $params);
                        };

                        // Proccessing Middleware if using A Controller With Action
                        $next = Middleware::handleMiddleware($middlewareStack, $next);

                        echo $next($uri);
                    }

                    return '';
                }
            }
        }

        throw new \Exception(' this route ' . $uri . ' not found');
    }
}
