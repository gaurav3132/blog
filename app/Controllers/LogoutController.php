<?php

namespace App\Controllers;

use System\Core\Controller;

class LogoutController extends Controller
{
    public function index()
    {
        unset($_SESSION['user_id']);

        if(!empty($_COOKIE['blogpost_user'])){
            setcookie('blogpost_user',null,time()-60,'/');
        }
        set_message('You have beeen logged out','primary');

        redirect(url('login'));
    }

}