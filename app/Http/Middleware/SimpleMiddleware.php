<?php
namespace App\Http\Middleware;

use Contracts\Middleware\Contract;
use Iliuminates\FrameworkSettings;

class SimpleMiddleware implements Contract
{
    /**
     * @param mixed $request
     * @param mixed $next
     *
     * @return mixed
     */
    public function handle($request, $next,...$role)
    {
       // var_dump($request);
        //FrameworkSettings::setLocale($_GET['lang']);
        
        // echo "<pre>";
        // var_dump($role[0]);
        // if($role[0] == 'user') {
        //     header('Location: '.url('about'));
        //     exit;
        // }

        return $next($request);
    }
}
