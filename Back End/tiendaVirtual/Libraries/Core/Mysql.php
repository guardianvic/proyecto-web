<?php 

class Mysql extends Conexion
{
    private $conexion;
    private $strquery;
    private $arrValues;

    public function __construct()
    {
        $this->conexion = (new Conexion())->conect();
    }

    /**
     * Insertar un registro en la base de datos
     * @param string $query - Consulta SQL con marcadores de posición (?)
     * @param array $arrValues - Valores a insertar en la consulta
     * @return int - ID del último registro insertado o 0 en caso de error
     */
    public function insert(string $query, array $arrValues)
    {
        $this->strquery = $query;
        $this->arrValues = $arrValues;
        $insert = $this->conexion->prepare($this->strquery);
        $resInsert = $insert->execute($this->arrValues);
        
        return ($resInsert) ? $this->conexion->lastInsertId() : 0;
    }

    /**
     * Buscar un único registro
     * @param string $query - Consulta SQL con marcadores de posición (?)
     * @param array $arrValues - Valores para la consulta (opcional)
     * @return array|null - Registro encontrado o null si no hay coincidencias
     */
    public function select(string $query, array $arrValues = [])
    {
        $this->strquery = $query;
        $result = $this->conexion->prepare($this->strquery);
        $result->execute($arrValues);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Obtener todos los registros
     * @param string $query - Consulta SQL con marcadores de posición (?)
     * @param array $arrValues - Valores para la consulta (opcional)
     * @return array - Lista de registros encontrados
     */
    public function select_all(string $query, array $arrValues = [])
    {
        $this->strquery = $query;
        $result = $this->conexion->prepare($this->strquery);
        $result->execute($arrValues);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Actualizar registros en la base de datos
     * @param string $query - Consulta SQL con marcadores de posición (?)
     * @param array $arrValues - Valores a actualizar
     * @return bool - True si la actualización fue exitosa, False en caso contrario
     */
    public function update(string $query, array $arrValues)
    {
        $this->strquery = $query;
        $this->arrValues = $arrValues;
        $update = $this->conexion->prepare($this->strquery);
        return $update->execute($this->arrValues);
    }

    /**
     * Eliminar un registro
     * @param string $query - Consulta SQL con marcadores de posición (?)
     * @param array $arrValues - Valores para la consulta (opcional)
     * @return bool - True si la eliminación fue exitosa, False en caso contrario
     */
    public function delete(string $query, array $arrValues = [])
    {
        $this->strquery = $query;
        $result = $this->conexion->prepare($this->strquery);
        return $result->execute($arrValues);
    }
}

?>
