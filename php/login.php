<?php
// Iniciar la sesión
session_start();

// Encabezados para AJAX
header('Content-Type: application/json');

// Incluir archivo de configuración
require_once 'config.php';

// Inicializar la respuesta
$response = [
    'success' => false,
    'message' => 'Error desconocido'
];

// Verificar si se recibieron datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanear los datos del formulario
    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $password = trim($_POST['password']);
    
    // Validaciones básicas
    if (empty($email) || empty($password)) {
        $response['message'] = 'Por favor, completa todos los campos.';
    } else {
        // Preparar consulta para recuperar usuario
        $sql = "SELECT id, name, email, password, created_at FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            
            // Verificar la contraseña
            if (password_verify($password, $user['password'])) {
                // Contraseña correcta, iniciar sesión
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['created_at'] = $user['created_at'];
                
                $response['success'] = true;
                $response['message'] = '¡Inicio de sesión exitoso!';
                $response['redirect'] = './dashboard.php';
            } else {
                // Contraseña incorrecta
                $response['message'] = 'La contraseña es incorrecta.';
            }
        } else {
            // Usuario no encontrado
            $response['message'] = 'No existe una cuenta con este correo electrónico.';
        }
        
        $stmt->close();
    }
}

// Devolver respuesta como JSON
echo json_encode($response);
?>