<?php

namespace Iliuminates\Middleware;

use Iliuminates\Http\Request;
use Iliuminates\Logs\Log;
use Iliuminates\Sessions\Session;

class CSRFToken
{
    /**
     * to handle and check the csrf token 
     */
    public function __construct()
    {

        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST' && (empty(Request::get('_token')) || Request::get('_token') !== Session::get('csrf_token'))) {
            throw new Log('Invalid CSRF token');
        }
    }

    /**
     * to generate a new csrf token 
     * @return string
     */
    public static function generateCSRFToken(): string
    {
        return bin2hex(random_bytes(32));
    }
}
