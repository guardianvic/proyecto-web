<?php
class Template
{
    public function headerAdmin($data = "")
    {
        $view_header = "Views/Template/header_admin.php";
        require_once($view_header);
    }

    public function footerAdmin($data = "")
    {
        $view_footer = "Views/Template/footer_admin.php";
        require_once($view_footer);
    }
}
?>
