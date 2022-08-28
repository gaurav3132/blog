<?php

    const BASEPATH= __DIR__;
    require BASEPATH . "/vendor/autoload.php";




    $app= new System\Core\SystemInit;

    $app->start();



    // $data = $user->select('name','age')->where('age','<',25)->orderBy('age','DESC')->limit('0','1')->get();




