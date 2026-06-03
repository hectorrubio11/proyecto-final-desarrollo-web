<?php
namespace Models;

use Config\Database;
use PDO;
use PDOException;

class BitacoraModel {
    private PDO $db;

    public function __construct()
    {
        $conexion = new Database();
        $this->db = $conexion->connect();
    }

    public function log($usuario, $accion) {
        try{
            $sql = "INSERT INTO bitacora (usuario, accion) VALUES (:usuario, :accion)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":usuario", $usuario);
            $stmt->bindParam(":accion", $accion);
            return $stmt->execute();
        } catch (PDOException $e){
            $fecha = date("Y-m-d H:i:s");
            $mensaje = "[$fecha] ERROR DB: " . $e->getMessage() . " | Intentó: $usuario -> $accion" . PHP_EOL;
            
            $rutaLog = BASE_PATH . "/logs/errores_criticos.log";
            
            file_put_contents($rutaLog, $mensaje, FILE_APPEND);
            
            return false;
        }
    }
}