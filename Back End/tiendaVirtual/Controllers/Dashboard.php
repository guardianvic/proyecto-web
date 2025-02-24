<<<<<<< HEAD
<?php

class Dashboard extends Controllers
{
    public function __construct()
    {
        parent::__construct();

          
    }

    public function dashboard()
    {
        $data = [
            'page_id' => 2,
            'page_tag' => "Dashboard - Tienda Virtual",
            'page_name' => "dashboard",
            'page_title' => "Dashboard - Tienda Virtual",
            
        ];

        $this->views->getView($this, "dashboard", $data);
    }
}
?>



=======
<?php

class Dashboard extends Controllers
{
    public function __construct()
    {
        parent::__construct();

          
    }

    public function dashboard()
    {
        $data = [
            'page_id' => 2,
            'page_tag' => "Dashboard - Tienda Virtual",
            'page_name' => "dashboard",
            'page_title' => "Dashboard - Tienda Virtual",
            
        ];

        $this->views->getView($this, "dashboard", $data);
    }
}
?>



>>>>>>> 5570422bcf7bbad6ace2e9f311da491ae8578f7f
