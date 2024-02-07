<?php

include_once ('Modelo.php');

class Fallero extends Modelo {
    private $dni;
    private $nombre;
    private $apellidos;
    private $cuota;
    private $id_falla;

    // Setters
    public function setDni($dni) {
        $this->dni = $dni;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function setCuota($cuota) {
        $this->cuota = $cuota;
    }

    public function setIdFalla($id_falla) {
        $this->id_falla = $id_falla;
    }

    public function actualizar() {
        // Crear la consulta SQL
        $sql = "UPDATE falleros SET nombre = ?, apellidos = ?, cuota = ?, id_falla = ? WHERE dni = ?";

        // Preparar la consulta
        $stmt = $this->conn->prepare($sql);

        // Ejecutar la consulta con los valores como un array
        $stmt->execute([$this->nombre, $this->apellidos, $this->cuota, $this->id_falla, $this->dni]);
    }
}

?>
