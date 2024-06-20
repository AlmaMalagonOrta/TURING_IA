<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_admin = $_POST['nombre_admin'];
    $contrasena_admin = $_POST['contrasena_admin'];

    // Verificar si el nombre de usuario ya existe
    $sql = "SELECT * FROM usuarios_admin WHERE nombre_admin = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombre_admin);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "El nombre de usuario ya está en uso.";
    } else {
        // Hashear la contraseña antes de guardarla
        $hashed_password = password_hash($contrasena_admin, PASSWORD_BCRYPT);

        // Insertar el nuevo usuario en la base de datos
        $sql = "INSERT INTO usuarios_admin (nombre_admin, contrasena_admin) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nombre_admin, $hashed_password);

        if ($stmt->execute()) {
            echo "Registro exitoso.";
            // Redirigir al usuario a la página de inicio de sesión
            header("Location: index.html");
        } else {
            echo "Error al registrar: " . $stmt->error;
        }
    }

    $stmt->close();
}

$conn->close();
?>
