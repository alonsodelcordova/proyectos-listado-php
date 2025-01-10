<?php


class Conexion{
    private $host = 'localhost';
    private $usuario = 'root';
    private $password = '';
    private $baseDatos = 'portafolio';
    private $conexion;

    public function __construct(){
        try{
            $this->conexion = new PDO("mysql:host=$this->host;dbname=$this->baseDatos", $this->usuario, $this->password);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "Error de conexion: " . $e->getMessage();
        }
    }

    public function getConexion(){
        return $this->conexion;
    }

    public function cerrarConexion(){
        $this->conexion = null;
    }

    public function ejecutar($sql) : int{
        $this->conexion->exec($sql);
        return $this->conexion->lastInsertId();
    }

    public function ejecutarConsulta($sql) : array{
        $resultado = $this->conexion->query($sql);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }
}