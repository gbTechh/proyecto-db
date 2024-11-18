<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $dbname = "DB_PF";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $nombre = $conn->real_escape_string($_POST["nombre"]);
    $apellido = $conn->real_escape_string($_POST["apellido"]);
    $username = $conn->real_escape_string($_POST["username"]);
    $password =  $conn->real_escape_string($_POST["password"]);
    $dni = $conn->real_escape_string($_POST["dni"]);
    $telefono = $conn->real_escape_string($_POST["telefono"]);
    $email = $conn->real_escape_string($_POST["email"]);

    $stmt = $conn->prepare("CALL InsertCliente(?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $nombre, $apellido, $username, $password, $dni, $telefono, $email);

    if ($stmt->execute()) {
        header("Location: login.php");
        echo "Registro exitoso.";
        exit();
    } else {
        echo "Error al registrar: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="registro.css">
</head>
<body>
    <div class="container">
        <h2>Registro de Usuario</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="nombre">Nombres:</label><br>
            <input type="text" id="nombre" name="nombre" required><br>
            <label for="apellido">Apellidos:</label><br>
            <input type="text" id="apellido" name="apellido" required><br>
            <label for="username">Usuario:</label><br>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Contraseña:</label><br>
            <input type="password" id="password" name="password" required><br>
            <label for="dni">DNI:</label><br>
            <input type="text" id="dni" name="dni" required><br>
            <label for="telefono">Teléfono:</label><br>
            <input type="tel" id="telefono" name="telefono" required><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>
            <input type="submit" value="Registrarse">
        </form>
        <a href="https://localhost/DB-PF/landing.php">Continuar sin iniciar sesión</a>
        <a href="https://localhost/DB-PF/login.php">Regresar a Login</a>
    </div>
</body>
</html>

