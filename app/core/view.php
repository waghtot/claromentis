<?php
class View
{
    public function __construct($data = NULL)
    {
        require_once TEMPLATE;

    }

    public static function render($data = NULL)
    {

        if(!empty($data)){
            $view = $data->view;
            require_once PAGES.self::findView($data->view);
        }else{
            require_once PAGES.'home.php';
        }

    }

    public static function partial($view, $data)
    {

        require PARTIAL.self::checkPath($view).'.php';
    }

    public static function checkPath($input)
    {
        if(strpos($input, '/')!== false)
        {
            $path = explode("/", $input);
            $key = count($path) -1;
            error_log('take path appart: '.print_r($path, 1));           
            $path[$key] = ucwords($path[$key]);
            $path = implode("/", $path);
            return $path;

        }else{
            return $input;
        }
    }

    public static function findView(string $view=null)
    {
        $flieList=[];
        $flieList = scandir(PAGES);
        foreach($flieList as $file){
            if(is_file(PAGES.$file)){
                if(strtolower($file) == strtolower($view.'.php')){
                    return $file;
                }
            }
        }
        return 'home.php';
    }

}