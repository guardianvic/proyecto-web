<<<<<<< HEAD
<?php 

class LoginModel extends Mysql
{   
    private $strUsuario;

    public function __construct()
    {
        parent::__construct();
    }   

    public function loginUser(string $usuario, string $password)
{
    $this->strUsuario = $usuario;

    // Consulta con SQL preparado
    $sql = "SELECT idpersona, password, status FROM persona WHERE email_user = ? AND status != 0";
    $arrParams = array($this->strUsuario);
    $request = $this->select($sql, $arrParams);

    if (!empty($request) && isset($request['password'])) {
        // Verificar la contraseña
        if (password_verify((string)$password, $request['password'])) { // Forzar a string
            return array("idpersona" => $request['idpersona'], "status" => $request['status']);
        } else {
            return array("error" => "Contraseña incorrecta");
        }
    } else {
        return array("error" => "Usuario no encontrado o inactivo");
    }
}

}
?>
=======
<?php 

class LoginModel extends Mysql
{   
    private $strUsuario;

    public function __construct()
    {
        parent::__construct();
    }   

    public function loginUser(string $usuario, string $password)
{
    $this->strUsuario = $usuario;

    // Consulta con SQL preparado
    $sql = "SELECT idpersona, password, status FROM persona WHERE email_user = ? AND status != 0";
    $arrParams = array($this->strUsuario);
    $request = $this->select($sql, $arrParams);

    if (!empty($request) && isset($request['password'])) {
        // Verificar la contraseña
        if (password_verify((string)$password, $request['password'])) { // Forzar a string
            return array("idpersona" => $request['idpersona'], "status" => $request['status']);
        } else {
            return array("error" => "Contraseña incorrecta");
        }
    } else {
        return array("error" => "Usuario no encontrado o inactivo");
    }
}

}
?>
>>>>>>> 5570422bcf7bbad6ace2e9f311da491ae8578f7f
