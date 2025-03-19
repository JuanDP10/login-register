<?php
// Configuración de la base de datos
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'sistema_usuarios');

// Intentar conectar a la base de datos MySQL
try {
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Verificar conexión
    if ($conn->connect_error) {
        throw new Exception("Error de conexión: " . $conn->connect_error);
    }
    
    // Establecer conjunto de caracteres
    $conn->set_charset("utf8");
} catch (Exception $e) {
    die("ERROR: No se pudo conectar a la base de datos. " . $e->getMessage());
}
?>