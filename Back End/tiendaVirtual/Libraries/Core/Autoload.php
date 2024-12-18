<?php

spl_autoload_register(function($class) {
    
    $file = "Libraries/Core/" . $class . ".php";

    
    if (file_exists($file)) {
        require_once($file);
    } else {
        
        die("No se pudo cargar la clase: $class");
    }
});



?>
