<?php
//autoloader
ob_start();

function autoloader($class) {

    $files = array();
    $files = scanAllDir();
    $load = findClass($files, $class);
    if(!empty($load)){
        loadClass($load);
    }
}

function scanAllDir($dir = null) {

    if(empty($dir)){
        $dir = BASE_DIR;
    }

    $result = [];
    foreach(scandir($dir) as $filename) {
        if ($filename[0] === '.') continue;
        $filePath = $dir . '/' . $filename;
        if (is_dir($filePath)) {
            foreach (scanAllDir($filePath) as $childFilename) {
                $result[] = $filename . '/' . $childFilename;
            }
        } else {
            $result[] = $filename;
        }
    }
    return $result;
}

function findClass($list, $class){

    if(is_array($list)){
        foreach($list as $location)
        {
            $separate = array();
            $separate = explode("/", $location);
            $name = explode('.', end($separate));

            if(mb_strtolower(current($name)) === mb_strtolower($class)){
                return $location;
            }
        }
    }
    return false;
}

function loadClass($location)
{
    require_once($location);
}

spl_autoload_register('autoloader');