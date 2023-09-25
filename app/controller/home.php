<?php
class Home
{
    public function __constract($data = NULL)
    {
        if($data !== NULL){
            return $this->index($data);
        }
    }

    public function index($data = null)
    {
        //get file list for view from all location reserved for process
        $page = new stdClass();
        $page->view = get_called_class();
        $obj = new CheckQueue(DISPLAY);
        $page->result = $obj->getFileList();
        $obj = new CheckQueue(QUEUE);
        $page->data['queue'] = $obj->getFileList();
        $obj = new CheckQueue(FAILED);
        $page->data['failed'] = $obj->getFileList();
        $obj = new CheckQueue(PROCESSED);
        $page->data['processed'] = $obj->getFileList();

        return $page;
    }

}