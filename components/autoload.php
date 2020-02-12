<?php
spl_autoload_register(function($className){
    $paths = array(
        '/models/',
        '/components/'
    );
    foreach($paths as $path){
        $file = ROOT.$path.$className.'.php';
        if(file_exists($file)){
            include_once($file);
        }
    }
});

