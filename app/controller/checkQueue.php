<?php

class CheckQueue extends Controller
{

    private $queueList;

    public function __construct(string $path = null)
    {
        if(!empty($path)){
            $this->setFileList($path);
            $this->index();
        }

    }

    private function index(){
        $files=[];
        $files = $this->getFileList();
        $this->setResponse($files);
        return $this->getResponse();
    }

    private function setResponse(array $input){
        $this->queueList=$input;
    }

    private function getResponse(){
        return $this->queueList;
    }

}