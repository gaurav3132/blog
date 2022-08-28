<?php

namespace System\Core;

use System\Exceptions\NotController;

class SystemInit
{
    public function start()
    {
        session_start();

        $parts=$this->getUrlParts();
        $this->loadController($parts);

    }



    private function getUrlParts(): array
    {
        $fullUrl= "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        $baseUrl=config('base_url');

        $uri=str_replace($baseUrl,'',$fullUrl);
        return explode('/',$uri);


    }

    public function loadController(array $parts)
    {
        if(!empty($parts[0])){
            $class= ucfirst($parts[0])."Controller";
        }
        else{
            $class=ucfirst(config('default_controller'))."Controller";
        }
        $controller= "App\Controllers\\{$class}";

        $obj= new $controller;

        if($obj instanceof Controller){
           if(!empty($parts[1])){
               $function= $parts[1];
           }
           else{
               $function='index';
           }
           if(!empty($parts[2])){
               $obj->{$function}($parts[2]);
           }
           else{
               $obj->{$function}();
           }

        }
        else{
            throw new NotController("Class '{$controller}' must inherit 'System\Core\Controller' class.");
        }


    }

}