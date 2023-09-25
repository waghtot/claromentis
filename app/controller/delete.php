<?php

class Delete extends Controller
{
    private $filename;

    public function __construct()
    {
        if(isset($_POST['filename'])){
            $this->filename = $_POST['filename'];
        }
        return $this->index();
    }

    private function index()
    {
        $location = $this->findFile($this->filename);
        if($location!== false)
        {
            switch($location){
                case 1:
                    unlink(QUEUE.$this->filename);
                    return true;
                break;
                case 2:
                    unlink(FAILED.$this->filename);
                    return true;
                break;
                case 3:
                    unlink(PROCESSED.$this->filename);
                    return true;
                break;
            }
        }

        return false;
    }
}