<?php

class Process extends Controller
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
                    new ProcessCSV($this->filename, QUEUE);
                break;
                case 2:
                    new ProcessCSV($this->filename, FAILED);
                break;
                case 3:
                    new ProcessCSV($this->filename, PROCESSED);
                break;
            }
        }
    }

}