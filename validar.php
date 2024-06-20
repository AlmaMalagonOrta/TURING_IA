<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_normal = $_POST['nombre_normal'];
    $contrasena_normal = $_POST['contrasena_normal'];

    // Consulta para verificar el usuario
    $sql = "SELECT * FROM usuarios_normales WHERE nombre_normal = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombre_normal);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verificar la contraseña
        if (password_verify($contrasena_normal, $row['contrasena_normal'])) {
            // Inicio de sesión exitoso
            $_SESSION['nombre_normal'] = $row['nombre_normal'];
            echo "Inicio de sesión exitoso.";
            // Redirigir al usuario a la página principal
            header("Location: api/index.html");
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
