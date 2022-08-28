<?php

namespace System\Core;

abstract class Controller
{

    protected  function login_check(){
        if(!login_check()){
            set_message('You must be logged in to continue','danger');
            redirect(url('login'));
        }
    }

}