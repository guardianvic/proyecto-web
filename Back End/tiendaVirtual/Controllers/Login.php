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
    if ($_POST) {
        if (empty($_POST['txtEmail']) || empty($_POST['txtPassword'])) {
            $arrResponse = ['status' => false, 'msg' => 'Error de datos'];
        } else {
            $strUsuario  = strtolower(strClean($_POST['txtEmail']));
            $strPassword = trim($_POST['txtPassword']); // Asegurar que no sea null
            var_dump($_POST['txtPassword']);
die();
            // Buscar usuario en la BD sin la contraseña
            $requestUser = $this->model->loginUser($strUsuario, $strPassword);

            if (isset($requestUser['error'])) {
                $arrResponse = ['status' => false, 'msg' => $requestUser['error']];
            } else {
                if ($requestUser['status'] == 1) {
                    $_SESSION['idUser'] = $requestUser['idpersona'];
                    $_SESSION['login'] = true;

                    // Cargar datos de sesión
                    $arrData = $this->model->sessionLogin($_SESSION['idUser']);
                    $_SESSION['userData'] = $arrData;

                    $arrResponse = ['status' => true, 'msg' => 'ok'];
                } else {
                    $arrResponse = ['status' => false, 'msg' => 'Usuario inactivo.'];
                }
            }
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    }
    die();
}



   

   
}
?>
