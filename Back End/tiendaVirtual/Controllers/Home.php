<?php

class Home extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function home()
    {
        $data['page_id'] = 1;
        $data['page_tag'] = "Tienda Virtual";
        $data['page_name'] = "Página Principal";
        $data['page_title'] = "home";
        $this->views->getView($this, "home", $data);
    }

    
}

?>
