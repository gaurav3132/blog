<?php

    if(!function_exists('config')){

        function config(string $key){
            require BASEPATH. '/config/settings.php';

            if(key_exists($key, $config)){
                return $config[$key];
            }
            else{
                return false;
            }
        }
    }
if(!function_exists('view')){

    function view(string $view, ?array $data=null){
        new \System\Core\View($view,$data);

    }
}

if(!function_exists('url')){
    function url(?string $uri = ''): string{
        return config('base_url').$uri;

    }
}

if(!function_exists('set_message')){
    function set_message(string $message,string $type='info'){
        $_SESSION['message']=[
            'content'=>$message,
            'type'=>$type,
        ];
    }
}

if(!function_exists('get_message')){
    function get_message(): array|false{
        if(!empty($_SESSION['message'])){
            return $_SESSION['message'];
        }
        else{
            return false;
        }
    }
}

if(!function_exists('clear_message')){
    function clear_message(){
        unset($_SESSION['message']);
    }
}

if(!function_exists('redirect')){
    function redirect(string $address){
        header('location: '.$address);
        die;
    }
}

if(!function_exists('login_check')){

    function login_check(): bool{
        if(!empty($_SESSION['user_id'])){
            return true;
        }
        else if(!empty($_COOKIE['blogpost_user'])){
            $_SESSION['user_id']=$_COOKIE['blogpost_user'];
            return true;
        }
        else{
            return false;
        }
    }
}

if(!function_exists('user')){

    function user(): \APP\Models\User{
        return new \App\Models\User($_SESSION['user_id']);
    }
}