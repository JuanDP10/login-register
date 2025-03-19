<?php
// Encabezados para AJAX
header('Content-Type: application/json');

// Incluir archivo de configuración
require_once 'config.php';

// Inicializar la respuesta
$response = [
    'success' => false,
    'message' => 'Error desconocido'
];

date_default_timezone_set('America/Bogota');

// Verificar si se recibieron datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanear los datos del formulario
    $name = trim(mysqli_real_escape_string($conn, $_POST['name']));
    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $password = trim($_POST['password']);
    
    // Validaciones en el servidor
    if (empty($name) || empty($email) || empty($password)) {
        $response['message'] = 'Todos los campos son obligatorios.';
    } elseif (strlen($name) < 3) {
        $response['message'] = 'El nombre debe tener al menos 3 caracteres.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = 'Por favor, introduce un correo electrónico válido.';
    } elseif (strlen($password) < 8) {
        $response['message'] = 'La contraseña debe tener al menos 8 caracteres.';
    } else {
        // Verificar si el correo electrónico ya existe
        $check_email = "SELECT id FROM users WHERE email = ?";
        $stmt = $conn->prepare($check_email);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $response['message'] = 'Este correo electrónico ya está registrado.';
        } else {
            // Hash de contraseña
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            
            // Preparar la consulta de inserción
            $fecha_actual = date("Y-m-d H:i:s"); // Formato de fecha y hora
            $insert_user = "INSERT INTO users (name, email, password, created_at) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_user);
            $stmt->bind_param("ssss", $name, $email, $password_hash, $fecha_actual);            
            
            // Ejecutar la consulta
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = '¡Registro exitoso! Ahora puedes iniciar sesión.';
            } else {
                $response['message'] = 'Error al registrar usuario. Por favor, inténtalo de nuevo.';
            }
        }
        
        $stmt->close();
    }
}

// Devolver respuesta como JSON
echo json_encode($response);
?>