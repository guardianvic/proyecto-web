<<<<<<< HEAD
<?php

class Controllers
{
    protected $views;
    protected $model;

    public function __construct()
    {
        
        if (class_exists('Views')) {
            $this->views = new Views();
        } else {
            
            die("La clase Views no existe.");
        }

        
        $this->loadModel();
    }

    public function loadModel()
    {
       
       $model = get_class($this) . "Model";
       $routClass = "Models/" . $model . ".php";
       
       
       if (file_exists($routClass)) {
           require_once($routClass);

           
           if (class_exists($model)) {
               $this->model = new $model();
           } else {
      
               die("La clase $model no existe en el archivo $routClass.");
           }
       } else {
          
           die("El archivo del modelo $routClass no se encontró.");
       }
    }
}
?>
=======
<?php

class Controllers
{
    protected $views;
    protected $model;

    public function __construct()
    {
        
        if (class_exists('Views')) {
            $this->views = new Views();
        } else {
            
            die("La clase Views no existe.");
        }

        
        $this->loadModel();
    }

    public function loadModel()
    {
       
       $model = get_class($this) . "Model";
       $routClass = "Models/" . $model . ".php";
       
       
       if (file_exists($routClass)) {
           require_once($routClass);

           
           if (class_exists($model)) {
               $this->model = new $model();
           } else {
      
               die("La clase $model no existe en el archivo $routClass.");
           }
       } else {
          
           die("El archivo del modelo $routClass no se encontró.");
       }
    }
}
?>
>>>>>>> 5570422bcf7bbad6ace2e9f311da491ae8578f7f
