<?php

class Fallero {
    private $bd;

    public function __construct($bd) {
        $this->bd = $bd;
    }

    public function obtenerFallero($dni) {
        $sql = "SELECT dni, nombre, apellidos, cuota, id_falla FROM falleros WHERE dni = ?";
        $consultaFallero = $this->bd->prepare($sql);
        $consultaFallero->execute([$dni]);
        return $consultaFallero->fetch();
    }

    public function actualizarFallero($dni, $nombre, $apellidos, $cuota, $id_falla) {
        try {
            $this->bd->beginTransaction();
            $sql = "UPDATE falleros SET nombre = ?, apellidos = ?, cuota = ?, id_falla = ? WHERE dni = ?";
            $pdoPreparada = $this->bd->prepare($sql);

            $arrParametros = [$nombre, $apellidos, $cuota, $id_falla, $dni];

            $resultado = $pdoPreparada->execute($arrParametros);

            if (!$resultado) {
                throw new Exception('No se ha podido realizar la actualización del fallero.<br>');
            }

            $this->bd->commit();
            return $pdoPreparada->rowCount();
        } catch (PDOException $e) {
            $this->bd->rollback();
            throw new Exception("Error en la BD: " . $e->getMessage());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}

?>