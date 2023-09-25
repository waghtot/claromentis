<?php

class CsvExporter
{
    private $fileToCsv = [];
    private $filename;
    public function __construct(array $input, string $name)
    {
        $this->fileToCsv = $input;
        $this->filename = $name;
        $this->index();
    }

    private function index()
    {
        $this->refreshDisplay();
        $this->writeFile();

    }

    private function refreshDisplay()
    {
        foreach(scandir(DISPLAY) as $file)
        {
            is_file(DISPLAY.$file) ? unlink(DISPLAY.$file) : '';
        }
    }

    private function writeFile()
    {
        $file = fopen(DISPLAY.$this->filename, 'w');

        foreach($this->fileToCsv as $key => $value){
            fputcsv($file, array($key, number_format((float)$value, 2, '.', '')));
        }
         
        fclose($file);
        
        // header('Content-type: text/csv');
        // header('Content-disposition:attachment; filename="'.DISPLAY.$this->filename.'"');
        // readfile(DISPLAY.$this->filename);
    }
}