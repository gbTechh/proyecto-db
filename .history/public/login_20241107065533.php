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

    $username = $conn->real_escape_string($_POST["username"]);
    $password_ingresado = $_POST["password"]; 

    $stmt = $conn->prepare("CALL VerificarUsuario(?, ?, @tipo_usuario, @nombre, @apellidos, @dni, @telefono, @email, @id_sucursal, @puesto)");
    $stmt->bind_param("ss", $username, $password_ingresado);
    $stmt->execute();

    $result = $conn->query("SELECT @tipo_usuario, @nombre, @apellidos, @dni, @telefono, @email, @id_sucursal, @puesto");
    $row = $result->fetch_assoc();

    if ($row['@tipo_usuario'] === 'Empleado' || $row['@tipo_usuario'] === 'Cliente') {
        $_SESSION['username'] = $username;
        $_SESSION['nombre'] = $row['@nombre'];
        $_SESSION['apellidos'] = $row['@apellidos'];
        $_SESSION['dni'] = $row['@dni'];
        $_SESSION['telefono'] = $row['@telefono'];
        
        if ($row['@tipo_usuario'] === 'Empleado') {
            $_SESSION['id_sucursal'] = $row['@id_sucursal'];
            $_SESSION['puesto'] = $row['@puesto'];
            header("Location: administrador.php");
        } else {
            $_SESSION['email'] = $row['@email'];
            header("Location: landing.php");
        }
        exit();
    } elseif ($row['@tipo_usuario'] === 'No encontrado') {
        echo "Usuario no encontrado.";
    } else {
        echo "Contraseña incorrecta.";
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
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="login.css"> 
</head>
<body>
    <div class="container">
        <h2>Iniciar sesión</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="username">Usuario:</label><br>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Contraseña:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Iniciar sesión">
        </form>
        <div class="signup">
            <p>¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a>.</p>
        </div>
    </div>
</body>
</html>