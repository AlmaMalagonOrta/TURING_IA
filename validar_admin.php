<<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_admin = $_POST['nombre_admin'];
    $contrasena_admin = $_POST['contrasena_admin'];

    // Consulta para verificar el usuario
    $sql = "SELECT * FROM usuarios_admin WHERE nombre_admin = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombre_admin);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verificar la contraseña
        if (password_verify($contrasena_admin, $row['contrasena_admin'])) {
            // Inicio de sesión exitoso
            $_SESSION['nombre_admin'] = $row['nombre_admin'];
            echo "Inicio de sesión exitoso.";
            // Redirigir al usuario a la página principal
            header("Location: principal_admin.html");
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Nombre de usuario no encontrado.";
    }

    $stmt->close();
}

$conn->close();
?>