<?php
class SQLSRVConnector
{
    private static $instance = null;
    private $connection;

    // Configura correctamente los detalles de la conexión
    private $host;  // Servidor
    private $username; // Autenticacion NO HAY
    private $password; // Autenticacino NO HAY
    private $database;  // Base de Datos

    private function __construct()
    {
        // archivo .env
        $this->loadEny(file: __DIR__ . '/../.env');
        // Obtener las variables
        $this->host = 'den1.mssql8.gear.host';
        $this->database = 'tconsulting';
        $this->username = 'tconsulting';
        $this->password = 'Ep0Wc6-2r1~1';     
        
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

       // Método para cargar el archivo .env
    private function loadEnv($file)
    {
        if (file_exists($file)) {
            $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                putenv(trim($line));
            }
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


