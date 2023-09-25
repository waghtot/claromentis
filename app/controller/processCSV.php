<?php

class ProcessCSV extends Controller{

    private $fileContent=[];
    private $fileToProcess;
    private $filePath;
    private $delimiter = ',';
    private $row;
    private $line = 0;
    public function __construct(string $filename=null, string $path=null)
    {
        if(!empty($filename) && !empty($path) )
        {
            $this->fileToProcess = $filename;
            $this->filePath = $path;
            $this->index();

            return true;
        }

        return false;
    }

    private function index()
    {

        $this->checkIfFileExists();
        $this->processFile();
        if($this->filePath !== PROCESSED){
            $this->moveFileToProcessedFolder();
        }

        return true;

    }

    private function checkIfFileExists()
    {
        if(is_file($this->filePath.$this->fileToProcess) !== true)
        {
            throw new Exception($this->fileToProcess.' does not exists or it is not a file');
        }
        return true;
    }

    private function processFile()
    {
        if(($handle = fopen($this->filePath.$this->fileToProcess, "r")) !== FALSE)
        {
            while (($this->row = fgetcsv($handle, 10000, $this->delimiter)) !== FALSE)
            {
                $this->line ++;
                $this->checkIfNotEmpty();
                $this->countColumns();
                if($this->checkIfKeyExists() == true){
                    $this->updateKeyValue();
                }else{
                    $this->addKey();
                }

            }

            fclose($handle);

            new CsvExporter($this->fileContent, $this->fileToProcess);
            return true;
        }

            $this->moveFileToFailedFolder();


        return false;
    }

    private function moveFileToProcessedFolder()
    {
        if(copy($this->filePath.$this->fileToProcess, PROCESSED.$this->fileToProcess))
        {
            unlink($this->filePath.$this->fileToProcess);
            return true;
        }else{
            throw new Exception($this->fileToProcess.' error during moving file to - Processed - folder.');
        }
    }

    private function moveFileToFailedFolder()
    {
        if(copy($this->filePath.$this->fileToProcess, FAILED.$this->fileToProcess))
        {
            unlink($this->filePath.$this->fileToProcess);
            return true;
        }else{
            throw new Exception($this->fileToProcess.' error during moving file to - Failed - folder.');
        }
    }

    private function checkIfNotEmpty()
    {
        if(!empty($this->row)){
            return true;
        }
        $this->moveFileToFailedFolder();
        throw new Exception($this->fileToProcess.' error during process failed on line '.$this->line.' file '.$this->fileToProcess.' moved to - Failed - folder.');

    }

    private function countColumns()
    {
        if(count($this->row)!= 3)
        {
            $this->moveFileToFailedFolder();
            throw new Exception($this->fileToProcess.' error during process failed on line '.$this->line.' file '.$this->fileToProcess.' moved to - Failed - folder. Too many columns.');
        }
        return true;
    }

    private function checkIfKeyExists()
    {
        return array_key_exists($this->row[0], $this->fileContent);
    }

    private function updateKeyValue()
    {
        $value = $this->fileContent[$this->row[0]];
        $this->fileContent[$this->row[0]] = number_format($value, 2, '.', '') + $this->coutnValue();
    }

    private function addKey()
    {
        $this->fileContent[$this->row[0]] = $this->coutnValue();
    }

    private function coutnValue()
    {
        $final = 0;
        if((isset($this->row[1]) && $this->row[1]>0) && (isset($this->row[2]) && $this->row[2]>0))
        {
            $final = number_format($this->row[1], 2, '.', '') * $this->row[2];
        }
        
        return number_format((float)$final, 2, '.', '');
    }


}