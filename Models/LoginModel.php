<?php

class LoginModel extends Mysql
{   


    public function __construct()
    {
        parent::__construct();
    }   


    public function loginUser(string $usuario, string $password)
        {
            $this->strUsuario = $usuario;
            $this->strPassword = $password;

            $request = $this->select($sql);
            return $request;
        }

}
?>
