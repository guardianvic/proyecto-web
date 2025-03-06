<<<<<<< HEAD
<?php
class Conexion {
    private $conect;

    public function __construct() {
        $connectionString = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        try {
            $this->conect = new PDO($connectionString, DB_USER, DB_PASSWORD);
            $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Conexión exitosa"; // habilitar  para verificar la conexión.
        } catch (PDOException $e) {
            $this->conect = null; // Asigna null si ocurre un error.
            error_log("Error de conexión a la base de datos: " . $e->getMessage()); // Log del error.
            throw new Exception("Error al conectar con la base de datos."); // Lanza una excepción.
        }
    }

    public function conect() {
        return $this->conect;
    }
}
?>
=======
<?php
class Conexion {
    private $conect;

    public function __construct() {
        $connectionString = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        try {
            $this->conect = new PDO($connectionString, DB_USER, DB_PASSWORD);
            $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Conexión exitosa"; // habilitar  para verificar la conexión.
        } catch (PDOException $e) {
            $this->conect = null; // Asigna null si ocurre un error.
            error_log("Error de conexión a la base de datos: " . $e->getMessage()); // Log del error.
            throw new Exception("Error al conectar con la base de datos."); // Lanza una excepción.
        }
    }

    public function conect() {
        return $this->conect;
    }
}
?>
>>>>>>> 5570422bcf7bbad6ace2e9f311da491ae8578f7f
