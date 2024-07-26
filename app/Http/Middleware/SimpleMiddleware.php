<?php
namespace App\Http\Middleware;

use Contracts\Middleware\Contract;

class SimpleMiddleware implements Contract
{
    /**
     * @param mixed $request
     * @param mixed $next
     *
     * @return mixed
     */
    public function handle($request, $next,$role = [])
    {
        // echo "<pre>";
        // var_dump($role);
        if($role[0] == 'user') {
            header('Location: '.url('about'));
            exit;
        }

        return $next($request);
    }
}
