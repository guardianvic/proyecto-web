<<<<<<< HEAD
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
=======
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
>>>>>>> 5570422bcf7bbad6ace2e9f311da491ae8578f7f
