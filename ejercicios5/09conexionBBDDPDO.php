<?php

class Conexion {
    private $host = 'localhost';
    private $dbname = 'biblioteca';
    private $usuario = 'root';
    private $password = '';
    public $conn;

    public function __construct() {
        try {
            $this->conn = new PDO( "mysql:host=$this->host;dbname=$this->dbname", $this->usuario, $this->password );
            $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            echo 'Conexión exitosa';
        } catch ( PDOException $e ) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}

$conexion = new Conexion();
?>
