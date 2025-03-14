<?php

class UsuariosModel extends Mysql
{
    private $intIdUsuario;
    private $strIdentificacion;
    private $strNombre;
    private $strApellido;
    private $strTelefono;
    private $strEmail;
    private $strPassword;
    private $strToken;
    private $intTipoId;
    private $intStatus;

    public function __construct()
    {
        parent::__construct();
    }

    public function validarEmail(string $email): bool
    {
        $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        $sql = "SELECT idpersona FROM persona WHERE email_user = ?";
        $arrParams = array($email);
        $request = $this->select($sql, $arrParams);
        return !empty($request);
    }

    
    public function insertUsuario(
        string $identificacion, 
        string $nombre, 
        string $apellido, 
        string $telefono, 
        string $email, 
        string $password, 
        int $tipoid, 
        int $status
    ) {
        $this->strIdentificacion = htmlspecialchars($identificacion, ENT_QUOTES, 'UTF-8');
        $this->strNombre = ucwords(htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8'));
        $this->strApellido = ucwords(htmlspecialchars($apellido, ENT_QUOTES, 'UTF-8'));
        $this->strTelefono = htmlspecialchars($telefono, ENT_QUOTES, 'UTF-8');
        $this->strEmail = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        $this->intTipoId = $tipoid;
        $this->intStatus = $status;

        if ($this->validarEmail($this->strEmail)) {
            return "exist";
        }

        $sql = "SELECT * FROM persona WHERE identificacion = ?";
        $arrParams = array($this->strIdentificacion);
        $request = $this->select($sql, $arrParams);

        if (empty($request)) {
            $hashPassword = empty($password) ? hash("SHA256", passGenerator()) : hash("SHA256", $password); 

            $query_insert = "INSERT INTO persona(
                identificacion, nombres, apellidos, telefono, email_user, password, rolid, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $arrData = array(
                $this->strIdentificacion,
                $this->strNombre,
                $this->strApellido,
                $this->strTelefono,
                $this->strEmail,
                $hashPassword,
                $this->intTipoId,
                $this->intStatus
            );
            return $this->insert($query_insert, $arrData);
        } else {
            return "exist";
        }
    }

   
    public function selectUsuarios()
    {
        $sql = "SELECT p.idpersona, p.identificacion, p.nombres, p.apellidos, p.telefono, p.email_user, p.status, r.idrol, r.nombrerol 
                FROM persona p 
                INNER JOIN rol r ON p.rolid = r.idrol 
                WHERE p.status != 0";
        return $this->select_all($sql);
    }

   
    public function selectUsuario(int $idpersona)
    {
        $sql = "SELECT p.idpersona, p.identificacion, p.nombres, p.apellidos, p.telefono, p.email_user, r.idrol, r.nombrerol, p.status, DATE_FORMAT(p.datecreated, '%d-%m-%Y') as fechaRegistro 
                FROM persona p
                INNER JOIN rol r ON p.rolid = r.idrol
                WHERE p.idpersona = ?";
        return $this->select($sql, [$idpersona]);
    }

    
    public function updateUsuario(
        int $idUsuario, 
        string $identificacion, 
        string $nombre, 
        string $apellido, 
        string $telefono, 
        string $email, 
        string $password, 
        int $tipoid, 
        int $status
    ) {
        $sql = "SELECT * FROM persona WHERE 
                (email_user = ? AND idpersona != ?) OR 
                (identificacion = ? AND idpersona != ?)";
        $arrParams = [$email, $idUsuario, $identificacion, $idUsuario];
        $request = $this->select_all($sql, $arrParams);

        if (empty($request)) {
            if (!empty($password)) {
                $hashPassword = hash("SHA256", $password); 
                $sql = "UPDATE persona SET 
                        identificacion = ?, 
                        nombres = ?, 
                        apellidos = ?, 
                        telefono = ?, 
                        email_user = ?, 
                        password = ?, 
                        rolid = ?, 
                        status = ? 
                        WHERE idpersona = ?";
                $arrData = [
                    $identificacion,
                    $nombre,
                    $apellido,
                    $telefono,
                    $email,
                    $hashPassword,
                    $tipoid,
                    $status,
                    $idUsuario
                ];
            } else {
                $sql = "UPDATE persona SET 
                        identificacion = ?, 
                        nombres = ?, 
                        apellidos = ?, 
                        telefono = ?, 
                        email_user = ?, 
                        rolid = ?, 
                        status = ? 
                        WHERE idpersona = ?";
                $arrData = [
                    $identificacion,
                    $nombre,
                    $apellido,
                    $telefono,
                    $email,
                    $tipoid,
                    $status,
                    $idUsuario
                ];
            }

            $this->update($sql, $arrData);
            return $this->selectUsuario($idUsuario);
        } else {
            return "exist";
        }
    }

   
    public function deleteUsuario(int $intIdpersona)
    {
        $sql = "UPDATE persona SET status = 0 WHERE idpersona = ?";
        return $this->update($sql, [$intIdpersona]);
    }
}
