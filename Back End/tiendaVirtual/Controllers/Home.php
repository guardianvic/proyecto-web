<<<<<<< HEAD
<?php

class Home extends Controllers
{
    public function __construct()
    {
        parent::__construct();
                
    }

    public function home()
    {
        $data = [
            'page_id' => 1,
            'page_tag' => "Tienda Virtual",
            'page_name' => "home",
            'page_title' => "Página Principal",
            
        ];

        $this->views->getView($this, "home", $data);
    }
}
=======
<?php

class Home extends Controllers
{
    public function __construct()
    {
        parent::__construct();
                
    }

    public function home()
    {
        $data = [
            'page_id' => 1,
            'page_tag' => "Tienda Virtual",
            'page_name' => "home",
            'page_title' => "Página Principal",
            
        ];

        $this->views->getView($this, "home", $data);
    }
}
>>>>>>> 5570422bcf7bbad6ace2e9f311da491ae8578f7f
?>