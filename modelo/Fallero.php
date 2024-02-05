<?php

class Fallero {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function obtenerFallero($dni) {
        $sql = "SELECT dni, nombre, apellidos, cuota, id_falla FROM falleros WHERE dni = ?";
        $consultaFallero = $this->conn->prepare($sql);
        $consultaFallero->execute([$dni]);
        return $consultaFallero->fetch();
    }

    public function actualizarFallero($dni, $nombre, $apellidos, $cuota, $id_falla) {
        try {
            $this->conn->beginTransaction();
            $sql = "UPDATE falleros SET nombre = ?, apellidos = ?, cuota = ?, id_falla = ? WHERE dni = ?";
            $pdoPreparada = $this->conn->prepare($sql);

            $arrParametros = [$nombre, $apellidos, $cuota, $id_falla, $dni];

            $resultado = $pdoPreparada->execute($arrParametros);

            if (!$resultado) {
                throw new Exception('No se ha podido realizar la actualización del fallero.<br>');
            }

            $this->conn->commit();
            return $pdoPreparada->rowCount();
        } catch (PDOException $e) {
            $this->conn->rollback();
            throw new Exception("Error en la BD: " . $e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}

?>