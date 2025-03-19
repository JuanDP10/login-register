<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="./images/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="dashboard">
            <div class="welcome-message">
                <h2><i class="fas fa-user-circle"></i> Bienvenido, <?php echo htmlspecialchars($_SESSION['user_name']); ?></h2>
                <p><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
            </div>
            <div class="dashboard-content">
                <h3><i class="fas fa-lock"></i> Sección Protegida</h3>
                <p>Este contenido solo es visible para usuarios autenticados.</p>
                <p><i class="fas fa-calendar-alt"></i> Fecha de registro: <?php echo htmlspecialchars($_SESSION['created_at']); ?></p>
            </div>
            <div class="actions">
                <br><a href="php/logout.php" class="btn logout-btn"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
            </div>
        </div>
    </div>
</body>
</html>