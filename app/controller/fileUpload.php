<?php

class FileUpload extends Controller{

    private $file;

    public function __construct()
    {
        
        if(isset($_FILES) && !empty($_FILES)){

            $this->sanitizeFileName();
            $this->file = $_FILES;
            $this->moveFileToTheQueue();
            new ProcessCSV($this->file['file']['name'], QUEUE);

        }

    }

    private function sanitizeFileName()
    {
        $pattern = ['?','[',']','/','\\','=','<','>',':',';',',', "'",'"','&','$','#','*','(',')','|','~','`','!','{','}','%','+','’','«','»','”','“',' '];
        $_FILES['file']['name'] = str_replace( $pattern, '', $_FILES['file']['name']);
        $_FILES['file']['full_path'] = str_replace( $pattern, '', $_FILES['file']['full_path']);
    }


    private function moveFileToTheQueue(){

        try{
            if ($this->file["file"]["error"] == UPLOAD_ERR_OK) {
                move_uploaded_file($this->file["file"]["tmp_name"], QUEUE.$this->file['file']['name']);
            }
        } catch (Throwable $e) {
            error_log('show message: '.print_r($e, 1));
        }
        
    }
}