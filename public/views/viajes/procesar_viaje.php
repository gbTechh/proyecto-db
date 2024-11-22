<?php
require '../../../init.php';

$servername = DB_HOST;
$username = DB_USER; 
$password = DB_PASS; 
$dbname = DB_NAME;

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vuelo_ida = json_decode($_POST['vuelo_ida'], true);
    $vuelo_regreso = json_decode($_POST['vuelo_regreso'], true);
    $paquete = json_decode($_POST['paquete'], true);
    $servicio = json_decode($_POST['servicio'], true);
    $hotel = json_decode($_POST['hotel'], true);
    $transporte = json_decode($_POST['transporte'], true);
    $guia = json_decode($_POST['guia'], true);
    $precio_total = $_POST['precio_total'];
    $duracion_viaje = intval($_POST['duracion_viaje']);

    if (!$vuelo_ida || !$vuelo_regreso) {
        die('Error: Faltan datos para confirmar la reserva.');
    }

    try {
        // Preparar los valores, manejando los casos nulos
        $dni = $_SESSION['dni'];
        $vuelo_ida_id = $vuelo_ida['id'];
        $vuelo_regreso_id = $vuelo_regreso['id'];
        $paquete_id = isset($paquete['id']) ? $paquete['id'] : null;
        $hotel_id = isset($hotel['id']) ? $hotel['id'] : null;
        $transporte_id = isset($transporte['id']) ? $transporte['id'] : null;
        $servicio_id = isset($servicio['id']) ? $servicio['id'] : null;
        $guia_id = isset($guia['id']) ? $guia['id'] : null;

        $sql = "INSERT INTO viaje (dni_cliente, vuelo_ida, vuelo_regreso, paquete_turistico, hotel, transporte, servicio, guia, precio, duracion) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        // Bind los parámetros usando variables intermedias
        $stmt->bind_param(
            "iiiiiiiidi", // Nota: cambiado a 'd' para precio que podría ser decimal
            $dni,
            $vuelo_ida_id,
            $vuelo_regreso_id,
            $paquete_id,
            $hotel_id,
            $transporte_id,
            $servicio_id,
            $guia_id,
            $precio_total,
            $duracion_viaje
        );

        if ($stmt->execute()) {
            echo "Reserva confirmada exitosamente.";
            // Opcional: Redirigir a una página de confirmación
            // header("Location: confirmacion.php");
            // exit;
        } else {
            echo "Error al confirmar la reserva: " . $stmt->error;
        }

        $stmt->close();
    } catch (Exception $e) {
        echo "Ocurrió un error: " . $e->getMessage();
    } finally {
        $conn->close();
    }
} else {
    echo "Método no permitido.";
}
?>