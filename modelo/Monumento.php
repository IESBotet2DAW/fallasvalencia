<?php

include_once("Modelo.php");

/* *******************************************************************************************
 
 * CLASE Monumento

 * ***************************************************************************************** */

class Monumento extends Modelo
{

    private $id;
    private $nombre;
    private $lema;
    private $presupuesto;
    private $anyo_creacion;
    private $id_falla;


    /* *******************************************************************************************
     * CONSTRUCTOR
     * ***************************************************************************************** */

    function __construct($nombre, $lema, $presupuesto, $anyo_creacion, $id_falla)
    {
        parent::__construct();

        $this->nombre = $nombre;
        $this->lema = $lema;
        $this->presupuesto = $presupuesto;
        $this->anyo_creacion = $anyo_creacion;
        $this->id_falla = $id_falla;

        // se carga el usuario
        // $this->cargar($login);

    }


    /* *******************************************************************************************
     * METODOS PRIVADOS
     * ***************************************************************************************** */

    // private function cargar($login)
    // {

    //     // cadena sql para realizar la carga
    //     $sql = "select id, login, password from usuario where login like '" . $login . "' ";

    //     // ejecución de la consulta
    //     $query = pg_exec($this->conn, $sql);

    //     // si se ha encontrado el usuario se cargan los valores
    //     if (pg_num_rows($query)) {

    //         // obteniendo los valores
    //         $arrCampos = pg_fetch_Array($query);
    //         $this->id = $arrCampos['id'];
    //         $this->login = $arrCampos['login'];
    //         $this->password = $arrCampos['password'];
    //     }
    // }


    /* *******************************************************************************************
     * METODOS PUBLICOS
     * ***************************************************************************************** */

    public function insertar()
    {

        try {

            // consulta de insercción
            $sql = "insert into monumentos (nombre, lema, presupuesto, anyo_creacion, id_falla)
            values (?, ?, ?, ?, ?);";

            // creamos el array de parámetros para actualizar la cuota de Adriana

            // inicializamos la transacción
            $this->conn->beginTransaction();

            // preparamos la consulta
            $pdoPreparada = $this->conn->prepare($sql);

            // ejecutamos la consulta preparada
            $resultado = $pdoPreparada->execute([$this->nombre, $this->lema, $this->presupuesto, $this->anyo_creacion, $this->id_falla]);

            // si no se ha podido actualizar se lanza el error
            // si no se ha actualizado nada también es un error
            if (!$resultado || !$pdoPreparada->rowCount()) {
                throw new PDOException("No se ha podido realizar la transacción.<br>");
            }

            // echo "Actualización correcta<br>";
            $this->conn->commit();

            // si la conexión no ha tenido éxito lo indicamos    
        } catch (PDOException $e) {
            echo "Error en la BD: " . $e->getMessage();

            // se deshace la transacción
            $this->conn->rollback();
        }
    }


    /* Métodos getters y setters */

    // public function getId()
    // {
    //     return $this->id;
    // }

    // public function getLogin()
    // {
    //     return $this->login;
    // }

    // public function getPassword()
    // {
    //     return $this->password;
    // }


    // public function setId($id)
    // {
    //     $this->id = $id;
    // }

    // public function setLogin($login)
    // {
    //     $this->login = $login;
    // }

    // public function setPassword($password)
    // {
    //     $this->password = $password;
    // }



    public function mostrarFallas()
    {

        $sql = "select id_falla, nombre from fallas";

        // ejecutamos la consulta
        $consulta = $this->conn->query($sql);
        $arrFallas = [];

        while ($registro = $consulta->fetch()) {
            $arrFallas[] = $registro;
        }

        return $arrFallas;
            
    }
    /* Métodos getters y setters */

    // public function getId()
    // {
    //     return $this->id;
    // }

    // public function getLogin()
    // {
    //     return $this->login;
    // }

    // public function getPassword()
    // {
    //     return $this->password;
    // }


    // public function setId($id)
    // {
    //     $this->id = $id;
    // }

    // public function setLogin($login)
    // {
    //     $this->login = $login;
    // }

    // public function setPassword($password)
    // {
    //     $this->password = $password;
    // }

}

?>