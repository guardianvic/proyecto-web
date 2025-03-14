<?php

class Login extends Controllers
{
    public function __construct()
    {
         session_start();
        if(isset($_SESSION['login']))
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

