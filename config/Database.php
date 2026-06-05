<?php
namespace Config;

use PDO;
use PDOException;

/**
 * Gestión de Conexión a la Base de Datos
 *
 * Clase encargada de almacenar las credenciales de acceso del servidor local
 * y de inicializar la conexión segura mediante la extensión PDO.
 */
class Database{
    /**
     * @var string Dirección del servidor de la base de datos.
     */
    private string $host = "localhost";
    
    /**
     * @var string Nombre de la base de datos del sistema.
     */
    private string $dbname = "tienda_mvc";
    
    /**
     * @var string Nombre de usuario para el acceso a MySQL.
     */
    private string $username = "root";
    
    /**
     * @var string Contraseña de acceso para el usuario de MySQL.
     */
    private string $password = "";
    
    /**
     * @var string Juego de caracteres para la codificación de datos.
     */
    private string $charset = "utf8mb4";

    /**
     * Inicializa y retorna la conexión PDO.
     *
     * Construye el Data Source Name (DSN), genera la instancia de PDO,
     * configura el manejo de errores mediante excepciones y establece el
     * modo de obtención de datos por defecto en formato de arreglo asociativo.
     *
     * @return \PDO Instancia de conexión configurada y lista para ejecutar consultas.
     */
    public function connect(): PDO{
        try{
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";
            $pdo = new PDO($dsn, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e){
            die('Error de conexión: '. $e->getMessage());
        }
    }

}

?>