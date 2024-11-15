<?php 


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
    <title><?= $title ?? 'Admin Panel' ?></title>
</head>
<body class="admin-panel">
    <div class="container">
        <?php include ROOT . '/admin/templates/navbar-admin.php'; ?>
        <main class="main-admin">
            <div class="header">
                
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
    
</body>
</html>