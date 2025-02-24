<?php 

class PermisosModel extends Mysql
{
    public $intIdpermiso;
    public $intRolid;
    public $intModuloid;
    public $r;
    public $w;
    public $u;
    public $d;

    public function __construct()
    {
        parent::__construct();
    }

    // Obtener todos los módulos activos
    public function selectModulos()
    {
        $sql = "SELECT * FROM modulo WHERE status != 0";
        return $this->select_all($sql);
    }

    // Obtener los permisos de un rol específico
    public function selectPermisosRol(int $idrol)
    {
        $sql = "SELECT * FROM permisos WHERE rolid = ?";
        return $this->select_all($sql, array($idrol));
    }

    // Obtener los detalles de un rol específico
    public function getRol(int $idrol)
    {
        $sql = "SELECT * FROM rol WHERE idrol = ?";
        return $this->select($sql, array($idrol));
    }

    // Eliminar todos los permisos de un rol
    public function deletePermisos(int $idrol)
    {
        $sql = "DELETE FROM permisos WHERE rolid = ?";
        return $this->delete($sql, array($idrol));
    }

    // Insertar permisos
    public function insertPermisos(int $idrol, int $idmodulo, int $r, int $w, int $u, int $d)
    {
        $sql = "INSERT INTO permisos(rolid,moduloid,r,w,u,d) VALUES(?,?,?,?,?,?)";
        $params = array($idrol, $idmodulo, $r, $w, $u, $d);
        return $this->insert($sql, $params);
    }
}
