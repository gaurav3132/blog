<?php

namespace App\Controllers;

use System\Core\Controller;
use App\Models\User;

class LoginController extends Controller
{
    public function __construct()
    {
        if(login_check()){
            redirect(url('dashboard'));
        }
    }
    
    public function index()
    {
        view('back/login/index.php');
    }

    public function check()
    {
        $user= new User;

        $check=$user->where('email',$_POST['email'])->where('password',sha1($_POST['password']))->first();

        if($check){
            if($check->status=='Active'){
                $_SESSION['user_id']=$check->id;

                if(!empty($_POST['remember']) && $_POST['remember']=='yes'){
                    setcookie('blogpost_user',$check->id,time() + 30*24*60*60,'/');
                }

                redirect(url('dashboard'));
            }
            else{
                set_message('Your account is inactive','danger');
                redirect(url('login'));
            }
        }
        else{
            set_message('Incorrect email/password','danger');

            redirect(url('login'));
        }
    }

}