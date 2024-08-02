<?php 
namespace Iliuminates;

use Iliuminates\Sessions\Session;

class FrameworkSettings 
{

    /**
     * to set a default timezone on mvc
     * @return void
     */
    public static function setTimeZone(){
        date_default_timezone_set(config('app.timezone'));
    }

    /**
     *  to get the current timezone on mvc
     * @return string
     */
    public static function getTimeZone(){
        return date_default_timezone_get();
    }

    /**
     * get current locale lang 
     * @return string
     */
    public static function getLocale(){
        return Session::has('locale') && !empty(Session::get('locale')) ?Session::get('locale'):config('app.locale');
    }

    
    /**
     * change locale lang
     * @param string $locale
     * 
     * @return string
     */
    public static function setLocale(string $locale):string{
    
        Session::make('locale', $locale);
   
        return Session::get('locale');
    }


}
