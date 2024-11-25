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

    $username = $conn->real_escape_string($_POST["username"]);
    $password_ingresado = $_POST["password"]; 

    // Llamar al procedimiento almacenado  
    $stmt = $conn->prepare("CALL VerificarUsuario(?)");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['c_password']; 
        // Verificar la contraseña
        if (password_verify($password_ingresado, $hashed_password)) {
            // Contraseña correcta, iniciar sesión
            $_SESSION['username'] = $username;
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['apellidos'] = $row['apellidos'];
            $_SESSION['dni'] = $row['dni'];
            $_SESSION['telefono'] = $row['telefono'];
            $_SESSION['email'] = $row['email'];
            
            // Redirigir al usuario
            header("Location: " . URLROOT ."/index.php");
            exit();
        } else {
            // Contraseña incorrecta
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario o Contraseña incorrectos.";
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
    <link rel="stylesheet" href="<?= URLROOT. "/public/assets/css/login.css"?>"> 
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