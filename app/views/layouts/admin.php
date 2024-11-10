<!DOCTYPE html>
<html>
<head>
    <title>Admin - <?php echo $data['title']; ?></title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />

    <link rel="stylesheet" href="<?php echo AssetHelper::css("admin.css")?>">
    <?php $this->renderStyles(); ?>
    <title><?php echo $data['title']; ?></title>
</head>
<body class="admin-panel">
    <div class="container">
        <?php include ROOT . '/app/views/templates/navbar-admin.php'; ?>
        <main class="main-admin">
            <?php echo $content; ?>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <?php $this->renderScripts(); ?>
</body>
</html>