<<<<<<< HEAD
<?php

class Views
{
    public function getView($controller, $view, $data = "")
    {
        $controller = get_class($controller);

        
        if ($controller == "Home") {
            $viewPath = "Views/" . $view . ".php";
        } else {
            $viewPath = "Views/" . $controller . "/" . $view . ".php";
        }

        if (file_exists($viewPath)) {
            require_once($viewPath);
        } else {
           
            die("Error: La vista $viewPath no se encontró.");
        }
    }
}
?>
=======
<?php

class Views
{
    public function getView($controller, $view, $data = "")
    {
        $controller = get_class($controller);

        
        if ($controller == "Home") {
            $viewPath = "Views/" . $view . ".php";
        } else {
            $viewPath = "Views/" . $controller . "/" . $view . ".php";
        }

        if (file_exists($viewPath)) {
            require_once($viewPath);
        } else {
           
            die("Error: La vista $viewPath no se encontró.");
        }
    }
}
?>
>>>>>>> 5570422bcf7bbad6ace2e9f311da491ae8578f7f
