<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Meta Información -->
    <meta charset="utf-8">
    <meta name="description" content="Tienda Virtual">
    <meta name="viewport" content="width=device-width, initial-scale=1">   
    <meta name="author" content="Victor Rojas">
    <meta name="theme-color" content="#009688">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Titulo -->
    <title><?= htmlspecialchars($data['page_tag'], ENT_QUOTES, 'UTF-8'); ?></title>

    <!-- Favicon -->
    <link rel="icon" href="<?= media(); ?>/images/favicon.ico">

 

<link rel="stylesheet" href="<?= media(); ?>/css/main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css">
<link rel="stylesheet" href="<?= media(); ?>/css/style.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Niconne&display=swap" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


</head>
<body class="app sidebar-mini">

    <!-- Header -->
    <header class="app-header">
        <a class="app-header__logo" href="<?= base_url(); ?>/dashboard">Tienda Virtual</a>
        <a class="app-sidebar__toggle" href="<?= base_url(); ?>/dashboard" data-toggle="sidebar" aria-label="Hide Sidebar"></a>

        <!-- Navegación -->
        <ul class="app-nav">
            <li class="dropdown">
                <a class="app-nav__item" href="#" data-bs-toggle="dropdown" aria-label="Open Profile Menu">
                    <i class="bi bi-person-fill fs-4"></i>
                </a>
                <ul class="dropdown-menu settings-menu dropdown-menu-right">
                    <li><a class="dropdown-item" href="<?= base_url(); ?>/opciones"><i class="bi bi-gear-fill fs-5"></i> Configuración</a></li>
                    <li><a class="dropdown-item" href="<?= base_url(); ?>/perfil"><i class="bi bi-person-fill fs-5"></i> Perfil</a></li>
                    <li><a class="dropdown-item" href="<?= base_url(); ?>/Logout"><i class="bi bi-door-open-fill fs-5"></i> Cerrar Sesión</a></li>
                </ul>
            </li>
        </ul>
    </header>

    <!-- Menú lateral -->
    <?php require_once("nav_admin.php"); ?>

</body>
</html>
