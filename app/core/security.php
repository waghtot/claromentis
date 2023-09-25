<?php

class Security
{

    public function __construct(){
        return $this->index();
    }

    public function index(){
        if($_SERVER['REQUEST_METHOD']=='POST'){ // check if POST request
            $data = apache_request_headers(); //get header information
            if(isset($data['Authorization']) && isset($_POST['auth'])){ //decode and compire authorization strings
                if(base64_decode($data['Authorization']) !== $_POST['auth']){
                    die;
                }
            }else{
                die;
            }
        }
    }
}