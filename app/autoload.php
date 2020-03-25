<?php

spl_autoload_register(function($className) {
    $file = PATH_CONTROLLERS."/". $className . ".php";
	if (file_exists($file)) {
		require_once $file;
	} else {
        $className = str_replace("Model\\", DIRECTORY_SEPARATOR, $className);
        $file = PATH_MODELS. $className . ".php";
        if (file_exists($file)) {
            require_once $file;
        } else {
            $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
            $file = PATH_MODELS. "/". $className . ".php";
            if (file_exists($file)) {
                require_once $file;
            }
        }
    }
});

