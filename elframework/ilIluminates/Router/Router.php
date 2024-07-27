<?php

namespace Iliuminates\Router;

use Iliuminates\Logs\Log;
use Iliuminates\Middleware\Middleware;

class Router
{
    protected static $routes = [];
    protected static $groupAttributes = [];
   
 
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
            'uri' => $route == '/'?$route:ltrim($route, '/'),
            'controller' => $controller,
            'action' => $action,
            'middleware' => $middleware
        ];
    
    }

    /**
     * @param mixed $attributes
     * @param mixed $callback
     * 
     * @return void
     */
    public static function group($attributes, $callback):void
    {
        $previousGroupAttribute  = static::$groupAttributes;
        static::$groupAttributes = array_merge(static::$groupAttributes, $attributes);
        call_user_func($callback, new self);
        static::$groupAttributes = $previousGroupAttribute;
    }

    /**
     * @param mixed $route
     * 
     * @return string
     */
    protected static function applyGroupPrefix($route):string
    {
        if (isset(static::$groupAttributes['prefix'])) {
            $full_route = rtrim(static::$groupAttributes['prefix'], '/') . '/' . ltrim($route, '/');
            return rtrim(ltrim($full_route, '/'), '/');
        } else {
            return $route;
        }
    }

    /**
     * @return array
     */
    protected static function getGroupMiddleware():array
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
        $uri = ltrim($uri, ROOT_DIR);
        $uri = empty($uri)?'/':$uri;
        $method = strtoupper($method);

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
        throw new Log("' this route ' . $uri . ' not found'");
    }
}
