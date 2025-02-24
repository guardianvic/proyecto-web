<<<<<<< HEAD
<?php

    $controller = ucwords($controller);
    $controllerFile = "Controllers/" . $controller . ".php";

    if (file_exists($controllerFile)) {
        require_once($controllerFile);

        
        if (class_exists($controller)) {
            $controller = new $controller();

          
            if (method_exists($controller, $method)) {
                $controller->{$method}($params);
            } else {
                
                require_once("Controllers/Error.php");
            }
            } else {
                
                require_once("Controllers/Error.php");
            }
            } else {
                
                require_once("Controllers/Error.php");
            }
?>
=======
<?php

    $controller = ucwords($controller);
    $controllerFile = "Controllers/" . $controller . ".php";

    if (file_exists($controllerFile)) {
        require_once($controllerFile);

        
        if (class_exists($controller)) {
            $controller = new $controller();

          
            if (method_exists($controller, $method)) {
                $controller->{$method}($params);
            } else {
                
                require_once("Controllers/Error.php");
            }
            } else {
                
                require_once("Controllers/Error.php");
            }
            } else {
                
                require_once("Controllers/Error.php");
            }
?>
>>>>>>> 5570422bcf7bbad6ace2e9f311da491ae8578f7f
