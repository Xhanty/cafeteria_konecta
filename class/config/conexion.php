<?php
class Conexion
{

    private $conexion;

    public function __construct()
    {
        $host = 'localhost';
        $db   = 'cafeteria_bd';
        $user = 'root';
        $pass = '';

        /*Es mejor pasar las opciones en el constructor*/
        $options = array(
            PDO::ATTR_EMULATE_PREPARES => FALSE,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            $this->conexion = new PDO(
                "mysql:host=" . $host . ";dbname=" . $db,
                $user,
                $pass,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
            );
        } catch (PDOException $e) {

            echo "Conexion fallida" . $e->getMessage();
            exit();
        }
    }

    public function getConexion()
    {
        return $this->conexion;
    }
}
