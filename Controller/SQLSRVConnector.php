<?php
class SQLSRVConnector
{
    private static $instance = null;
    private $connection;

    // Detalles de la conexión
    private $host;          // Servidor
    private $username;      // Autenticación SQL
    private $password;      // Autenticación SQL
    private $database;      // Nombre de la base de datos

    // Constructor conexión PDO
    private function __construct()
    {
        // Cargar .env
        $this->loadEnv(_DIR_ . '/../.env');

        // Variables de entorno
        $this->host = 'den1.mssql8.gear.host';
        $this->database = 'tconsulting';
        $this->username = 'tconsulting';
        $this->password = 'Sh2z??Gc0e89'; 

        try {
            // Cadena de conexión DSN
            $dsn = "sqlsrv:Server={$this->host};Database={$this->database}";
            // Crea una instancia PDO usando el DSN y las credenciales
            $this->connection = new PDO($dsn, $this->username, $this->password);

            // Errores para PDO
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Mensaje de error, ausencia de coneccion.
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

    // Singleton para obtener una única instancia de la conexión
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new SQLSRVConnector();
        }
        return self::$instance;
    }

    // Público conexión activa
    public function getConnection()
    {
        return $this->connection;
    }
}
