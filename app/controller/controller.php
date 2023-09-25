<?php

class Controller{
    
    private $fileList=[];

    public function setFileList(string $path)
    {
        foreach(scandir($path) as $filename){
            if(is_file($path.$filename)==true){
                array_push($this->fileList, $filename);
            }
        }
        $source = explode('/', $path);
        array_push($this->fileList, ucfirst($source[count($source)-2]));
    }

    public function getFileList(){
        return $this->fileList;
    }

    public static function findFile(string $input)
    {
        if(is_file(QUEUE.$input) == true)
        {
            return 1;
        }

        if(is_file(FAILED.$input) == true)
        {
            return 2;
        }

        if(is_file(PROCESSED.$input) == true)
        {
            return 3;
        }

        return false;

    }

    public static function readFile($input)
    {
        $delimiter = ',';
        $output = [];
        if(($handle = fopen(DISPLAY.$input, "r")) !== FALSE)
        {
            while (($row = fgetcsv($handle, 10000, $delimiter)) !== FALSE)
            {
                $output[]=$row;
            }

            fclose($handle);
            return $output;
        }
    }
}