<?php

namespace System\Core;



class View
{

    public function __construct(string $view, ?array $data=null){
        $file= BASEPATH."/views/".$view;

        if(!is_null($data)){
            extract($data);
        }

        require $file;


    }

}