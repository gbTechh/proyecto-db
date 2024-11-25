<?php
require '../init.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //actualizar datos aqui
    $servername = DB_HOST;
    $username = DB_USER; 
    $password = DB_PASS; 
    $dbname = DB_NAME;

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $nombre = trim($_POST["nombre"]);
    $apellido = trim($_POST["apellido"]);
    $username = trim($_POST["username"]);
    $raw_password = $_POST["password"];
    $hashed_password = password_hash($raw_password, PASSWORD_BCRYPT);
    $dni = trim($_POST["dni"]);
    $telefono = trim($_POST["telefono"]);
    $email = trim($_POST["email"]);

    // Validaciones
    $errores = [];

    if (strlen($nombre) > 100) {
        $errores[] = "El nombre no debe tener más de 100 caracteres.";
    }
    if (strlen($apellido) > 100) {
        $errores[] = "El apellido no debe tener más de 100 caracteres.";
    }
    if (strlen($username) > 10) {
        $errores[] = "El nombre de usuario no debe tener más de 10 caracteres.";
    }
    if (!preg_match('/^9\d{8}$/', $telefono)) {
        $errores[] = "El teléfono debe contener exactamente 9 dígitos y empezar con 9.";
    }
    if (!preg_match('/^\d{8}$/', $dni)) {
        $errores[] = "El DNI debe contener exactamente 8 dígitos.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El email no tiene un formato válido.";
    }
    if (strlen($raw_password) <= 6) {
        $errores[] = "La contraseña debe tener más de 6 caracteres.";
    }
    $username_check_query = $conn->prepare("SELECT COUNT(*) FROM cliente WHERE c_username = ?");
    $username_check_query->bind_param("s", $username);
    $username_check_query->execute();
    $username_check_query->bind_result($username_count);
    $username_check_query->fetch();
    $username_check_query->close();
  
    if ($username_count > 0) {
        $errores[] = "El nombre de usuario ya está en uso. Por favor, elige otro.";
    }
    $email_check_query = $conn->prepare("SELECT COUNT(*) FROM cliente WHERE email = ?");
    $email_check_query->bind_param("s", $email);
    $email_check_query->execute();
    $email_check_query->bind_result($email_count);
    $email_check_query->fetch();
    $email_check_query->close();
  
    if ($email_count > 0) {
        $errores[] = "El email ya está en uso. Por favor, elige otro.";
    }
    $dni_check_query = $conn->prepare("SELECT COUNT(*) FROM cliente WHERE dni = ?");
    $dni_check_query->bind_param("s", $dni);
    $dni_check_query->execute();
    $dni_check_query->bind_result($dni_count);
    $dni_check_query->fetch();
    $dni_check_query->close();
 
    if ($dni_count > 0) {
        $errores[] = "El dni ya está en uso. Por favor, elige otro.";
    }
    // Mostrar errores o procesar registro
    if (!empty($errores)) {
        foreach ($errores as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    } else {
        // Preparar y ejecutar consulta
        $stmt = $conn->prepare("CALL InsertCliente(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $nombre, $apellido, $username, $hashed_password, $dni, $telefono, $email);

        if ($stmt->execute()) {
            header("Location: login.php");
            echo "Registro exitoso.";
            exit();
        } else {
            echo "Error al registrar: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="public/assets/css/registro.css">
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
        <a href="<?php echo URLROOT . "/login.php"?>">Continuar sin iniciar sesión</a></span>
        <a href="login.php">Regresar a Login</a>
    </div>
</body>
</html>

