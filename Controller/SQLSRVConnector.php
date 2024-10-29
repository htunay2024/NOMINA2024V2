<?php
class SQLSRVConnector
{
    private static $instance = null;
    private $connection;

    // Configura correctamente los detalles de la conexión
    private $host = 'DESKTOP-2C3S85H\HARVY';  // Servidor
    private $username = null;           // Autenticacion NO HAY
    private $password = null;           // Autenticacino NO HAY
    private $database = 'TConsulting';  // Base de Datos

    private function __construct()
    {
        // Cargar el archivo .env
        $this->loadEny(file: __DIR__ . '/../.env');
        // Obtener las variables de entorno
        $this->host = 'den1.mssql8.gear.host';
        $this->database 'tconsulting';
        $this->username = 'tconsulting'; // Asigna el valor si usas autenticación
        $this->password = 'Ep0Wc6-2-1-1'; // Asigna el valor si usas autenticación        
        
        try {
            // Verifica que los datos de conexión sean válidos
            $dsn = "sqlsrv:Server={$this->host};Database={$this->database}";
            $this->connection = new PDO($dsn, $this->username, $this->password);

            // Configura el modo de errores para PDO
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Muestra un mensaje de error si no se puede conectar
            die("Database Connection Failed: " . $e->getMessage());
        }
    }

    // Singleton para obtener una sola instancia de la conexión
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new SQLSRVConnector();
        }
        return self::$instance;
    }

    // Método para obtener la conexión activa
    public function getConnection()
    {
        return $this->connection;
    }
}

