<?php
class Database {
    private $hostname = "localhost";
    private $username = "root";
    private $password = "123456";
    private $database = "parque";
    private $charset = "utf8";
    
    function conectar()
    {
        try {
            // Corregir la variable $charset y la cadena de conexión
            $conexion = "mysql:host=" . $this->hostname . ";dbname=" . $this->database . ";charset=" . $this->charset;
            
            $opcion = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_FOUND_ROWS => true
            ];

            $pdo = new PDO($conexion, $this->username, $this->password, $opcion);

            return $pdo;
        } catch (PDOException $e) {
            echo 'Error de conexión: ' . $e->getMessage();
            exit;
        }
    }
}
?>
