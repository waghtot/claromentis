<?php

class Session
{
    public static function set($key, $value = null)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }else{
            return false;
        }
    }

    public static function kill($key){
        if(isset($_SESSION[$key]))
        {
            unset($_SESSION[$key]);
        }
    }

    public static function check($key){
        if(isset($_SESSION[$key])){
            return true;
        }
        return false;
    }
}