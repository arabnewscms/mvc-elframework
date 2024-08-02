<?php
namespace Iliuminates\Sessions;

use Iliuminates\Hashes\Hash;

class Session
{

    public function __construct()
    {
        $handler = new SessionHandler(config('session.session_save_path'),
        config('session.session_prefix'));
        $handler->gc(config('session.expiration_timeout'));
        
        session_set_save_handler($handler,true);
        session_save_path(config('session.session_save_path'));
        session_name(config('session.session_prefix'));
        session_start([
            'cookie_lifetime' => config('session.expiration_timeout')
        ]);
    }
    
    /**
     * @param string $key
     * @param mixed|null $value
     * 
     * @return mixed
     */
    public static function make(string $key, mixed $value = null): mixed
    {
        if (!is_null($value)) {
            $_SESSION[$key] = Hash::encrypt($value);
        }
        return isset($_SESSION[$key]) ? Hash::decrypt($_SESSION[$key]) : '';
    }
    
    /**
     * @param string $key
     * 
     * @return mixed
     */
    public static function get(string $key): mixed
    {
        return isset($_SESSION[$key]) ? Hash::decrypt($_SESSION[$key]) : $key;
    }


    /**
     * @param string $key
     * 
     * @return mixed
     */
    public static function has(string $key): mixed
    {
        return isset($_SESSION[$key]);
    }


    /**
     * @param string $key
     * @param mixed|null $value
     * 
     * @return mixed
     */
    public static function flash(string $key, mixed $value = null): mixed
    {
        if (!is_null($value)) {
            $_SESSION[$key] = $value;
        }
        $session = isset($_SESSION[$key]) ? Hash::decrypt($_SESSION[$key]) : '';
        self::forget($key);
        return $session;
    }

    /**
     * @param string $key
     * 
     * @return void
     */
    public static function forget(string $key):void
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }


    /**
     * @return void
     */
    public static function forget_all():void
    {
        session_destroy();
    }


}