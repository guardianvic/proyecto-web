<?php

class Login extends Controllers
{
    public function __construct()
    {
         session_start();
        //if(isset($_SESSION['login']))
        {
            //header('Location: ' . base_url().'/dashboard');
        }

        parent::__construct();
    }

    public function login()
    {
        $data = [
            'page_tag' => "Login",
            'page_title' => "Tienda Virtual",
            'page_name' => "login",
            'page_functions_js' => "functions_login.js"
        ];

        $this->views->getView($this, "login", $data);
    }

    public function loginUser()
    {
            //dep($_POST);
            if($_POST){
                if(empty($_POST['txtEmail']) || empty($_POST['txtPassword'])){
                    $arrResponse = array('status' => false, 'msg' => 'Error de datos' );
                }else{
                    $strUsuario  =  strtolower(strClean($_POST['txtEmail']));
                    $strPassword = hash("SHA256",$_POST['txtPassword']);
                    $requestUser = $this->model->loginUser($strUsuario, $strPassword);
                  dep($requestUser);
                }
                
            }
            die();
    }

} 

?>


