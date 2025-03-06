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
			//HomeModel.php
			$model = get_class($this)."Model";
			$routClass = "Models/".$model.".php";
			if(file_exists($routClass)){
				require_once($routClass);
				$this->model = new $model();
			}
		}
	}

 ?>