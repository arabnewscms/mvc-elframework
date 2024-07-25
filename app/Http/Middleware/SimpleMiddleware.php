<?php 
namespace App\Http\Middleware;

use Contracts\MiddlewareContract;

class SimpleMiddleware implements MiddlewareContract
{
    /**
     * @param mixed $request
     * @param mixed $next
     * 
     * @return mixed
     */
    public function handle($request, $next)
    {
        // echo "<pre>";
        // var_dump($next);
        if(2 == 2){
            header('Location: '.url('about'));
            exit;
        }

        return $next($request);
    }
}