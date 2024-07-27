<?php
namespace Iliuminates\Views;

class View
{

    public static function make($view, null|array $data)
    {
        $view = str_replace('.', '/', $view);
        $path = config('view.path');
        extract($data); 
        include $path.'/'.$view.'.tpl.php';
    }
}
