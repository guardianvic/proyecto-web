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
            'page_title' => "Dashboard - Tienda Virtual",
            'page_name' => "dashboard"
        ];

        $this->views->getView($this, "dashboard", $data);
    }
}
?>