<?php
class Router extends Definitions
{

    public function __construct()
    {
        return $this->dispatch();
    } 


    public static function dispatch()
    {

        if(isset($_SERVER['REQUEST_URI']))
        {
            self::requestType();
        }

    }

    public static function requestType(){

        $rqsMethod = strtolower($_SERVER['REQUEST_METHOD']);

        switch($rqsMethod)
        {
           case 'post':
            Definitions::getPost();
           break;
           case 'get':
            Definitions::getGet();
           break;
        }
    }

}