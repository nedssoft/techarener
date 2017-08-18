<?php

spl_autoload_register('Autoloader::base');

class Autoloader
{
 

    public static function base($class)
    {
        $base_url       = $_SERVER['DOCUMENT_ROOT'];

        $root           = $base_url.'/';

        $model          = $base_url.'/models/';

        $controller     = $base_url.'/controllers/';
        



        $ext = '.php';

        if(file_exists($class.$ext))
            require_once $class.$ext;

        elseif(file_exists($root.$class.$ext))
            require_once $root.$class.$ext;

        elseif(file_exists($model.$class.$ext))
            require_once $model.$class.$ext;

        elseif(file_exists($controller.$class.$ext))
            require_once $controller.$class.$ext;

       
    }
    
}
    

