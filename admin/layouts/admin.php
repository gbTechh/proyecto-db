<?php 


if (!isset($_SESSION['empleado'])) {
    header('Location: login.php');
    exit;
}

$name = $_SESSION['empleado']['nombre'];
$rol = $_SESSION['empleado']['rol'];

?>


<!DOCTYPE html>
<html>
<head>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />

    <link rel="stylesheet" href="<?php echo URLROOT . "/admin/assets/css/main.css"?>">
    <link rel="stylesheet" href="<?php echo URLROOT . "/admin/assets/css/layout.css"?>">
    <?php 
    if (isset($styles)) {
        foreach ($styles as $style) {
            echo "<link rel='stylesheet' href='" . URLROOT . "/admin/assets/css/{$style}.css'>\n";
        }
    }
    ?>
    <title><?= $title ? $title  : 'Admin Panel'  ?></title>
</head>
<body class="admin-panel">
    <div class="container">
        <?php include ROOT . '/admin/templates/navbar-admin.php'; ?>
        <main class="main-admin">
            <div class="header">
                <div>
                    <span>Bienvenido, <strong><?= $name;?></strong><?= " (". $_SESSION['empleado']['rol'] . ")"?></span>
                </div>
                <div class="div-btn">
                    <a href="<?php echo URLROOT. "/admin/reservas.php"?>" class="btn-reserva">Reservas</a>
                </div>
            </div>
            <div class="body">
               <?= $content ?? '' ?>
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <?php 
    if (isset($scripts)) {
        foreach ($scripts as $script) {
            echo "<script src='". URLROOT. "/admin/assets/js/{$script}.js'></script>\n";
        }
    }
    ?>

    <script>
        // Código de hot-reload integrado
        const watchFiles = () => {
            const timestamp = new Date().getTime();
            fetch('/agencia/check-changes.php?t=' + timestamp)
                .then(response => response.json())
                .then(data => {
                    if (data.hasChanged) {
                        window.location.reload();
                    } else {
                        setTimeout(watchFiles, 1000);
                    }
                })
                .catch(error => {
                    console.error('Error checking for changes:', error);
                    setTimeout(watchFiles, 1000);
                });
        };

        // Iniciar la vigilancia cuando se carga la página
        document.addEventListener('DOMContentLoaded', watchFiles);
    </script>

    
</body>
</html>