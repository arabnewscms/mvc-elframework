<?php
namespace Iliuminates\Router;
 
class Router
{
    protected $routes = [
        'GET'=>[],
        'POST'=>[],
        'PUT'=>[],
        'PATCH'=>[],
        'DELETE'=>[],
    ];

    public function add(string $method, string $route, $controller, $action, array $middleware = [])
    {
        $route = ltrim($route, '/');
        $this->routes[$method][$route]  = compact('controller', 'action', 'middleware');
    }

    public function routes()
    {
        return $this->routes;
    }


    public function dispatch($uri,$method){
        $uri = ltrim($uri, '/public/');
        if(isset($this->routes[$method][$uri])){
            $data = $this->routes[$method][$uri];
            if(is_object($data['action'])){
                $data['action']();
            }else{
                call_user_func_array([new $data['controller'],$data['action']],[]);
            }
        }else{
             throw new \Exception(' this route '.$uri.' not found');
        }
 
    }

}
