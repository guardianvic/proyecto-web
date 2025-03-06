<<<<<<< HEAD
<?php

class Mysql extends Conexion
{
    private $conexion;  // Conexión a la base de datos
    private $pdo;       // Objeto PDO
    private $strquery;  // Consulta SQL
    private $strQuery;  // Alias para consultas específicas
    private $arrValues; // Valores para consultas SQL
    private $arrParams; // Parámetros para consultas SQL

    public function __construct()
    {
        $this->conexion = new Conexion();
        $this->pdo = $this->conexion->conect(); // Establecer conexión con PDO
    }

    // Insertar un registro
    public function insert($query, $params)
    {
        $this->strQuery = $query;
        $this->arrParams = $params;

        try {
            $stmt = $this->pdo->prepare($this->strQuery);
            $stmt->execute($this->arrParams);
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Error en la consulta insert: " . $e->getMessage());
        }
    }

    // Busca un registro
    public function select(string $query, array $params = [])
    {
        $this->strquery = $query;

        try {
            $result = $this->pdo->prepare($this->strquery);
            $result->execute($params);
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error en la consulta select: " . $e->getMessage());
        }
    }

    // Devuelve todos los registros
    public function select_all($query, $params = [])
    {
        $this->strQuery = $query;
        $this->arrParams = $params;

        try {
            $stmt = $this->pdo->prepare($this->strQuery);
            $stmt->execute($this->arrParams);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error en la consulta select_all: " . $e->getMessage());
        }
    }

    // Actualiza registros
    public function update(string $query, array $arrValues)
    {
        $this->strquery = $query;
        $this->arrValues = $arrValues;

        try {
            $update = $this->pdo->prepare($this->strquery);
            return $update->execute($this->arrValues);
        } catch (PDOException $e) {
            throw new Exception("Error en la consulta update: " . $e->getMessage());
        }
    }

    // Eliminar un registro 
    public function delete(string $query, array $params = [])
    {
    $this->strquery = $query;

    try {
        $stmt = $this->pdo->prepare($this->strquery);
        return $stmt->execute($params); 
    } catch (PDOException $e) {
        throw new Exception("Error en la consulta delete: " . $e->getMessage());
    }
    }

    }
?>
=======
<?php

class Mysql extends Conexion
{
    private $conexion;  // Conexión a la base de datos
    private $pdo;       // Objeto PDO
    private $strquery;  // Consulta SQL
    private $strQuery;  // Alias para consultas específicas
    private $arrValues; // Valores para consultas SQL
    private $arrParams; // Parámetros para consultas SQL

    public function __construct()
    {
        $this->conexion = new Conexion();
        $this->pdo = $this->conexion->conect(); // Establecer conexión con PDO
    }

    // Insertar un registro
    public function insert($query, $params)
    {
        $this->strQuery = $query;
        $this->arrParams = $params;

        try {
            $stmt = $this->pdo->prepare($this->strQuery);
            $stmt->execute($this->arrParams);
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            throw new Exception("Error en la consulta insert: " . $e->getMessage());
        }
    }

    // Busca un registro
    public function select(string $query, array $params = [])
    {
        $this->strquery = $query;

        try {
            $result = $this->pdo->prepare($this->strquery);
            $result->execute($params);
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error en la consulta select: " . $e->getMessage());
        }
    }

    // Devuelve todos los registros
    public function select_all($query, $params = [])
    {
        $this->strQuery = $query;
        $this->arrParams = $params;

        try {
            $stmt = $this->pdo->prepare($this->strQuery);
            $stmt->execute($this->arrParams);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error en la consulta select_all: " . $e->getMessage());
        }
    }

    // Actualiza registros
    public function update(string $query, array $arrValues)
    {
        $this->strquery = $query;
        $this->arrValues = $arrValues;

        try {
            $update = $this->pdo->prepare($this->strquery);
            return $update->execute($this->arrValues);
        } catch (PDOException $e) {
            throw new Exception("Error en la consulta update: " . $e->getMessage());
        }
    }

    // Eliminar un registro 
    public function delete(string $query, array $params = [])
    {
    $this->strquery = $query;

    try {
        $stmt = $this->pdo->prepare($this->strquery);
        return $stmt->execute($params); 
    } catch (PDOException $e) {
        throw new Exception("Error en la consulta delete: " . $e->getMessage());
    }
    }

    }
?>
>>>>>>> 5570422bcf7bbad6ace2e9f311da491ae8578f7f
