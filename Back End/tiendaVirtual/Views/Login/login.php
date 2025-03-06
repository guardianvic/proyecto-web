<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Tienda Virtual">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Victor Rojas">
    <meta name="theme-color" content="#009688">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?= htmlspecialchars($data['page_tag'], ENT_QUOTES, 'UTF-8'); ?></title>

    <link rel="icon" href="<?= media(); ?>/images/favicon.ico">
    <link rel="stylesheet" href="<?= media(); ?>/css/main.css">
    <link rel="stylesheet" href="<?= media(); ?>/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>

    <section class="login-content">
        <div class="logo">
            <h1><?= htmlspecialchars($data['page_title'], ENT_QUOTES, 'UTF-8'); ?></h1>
        </div>

        <div class="login-box">
            

            <!-- Formulario de inicio de sesión -->
            <form class="login-form" name="formLogin" id="formLogin" action="#" method="POST" autocomplete="on">
                <h3 class="login-head">
                    <i class="bi bi-person-fill"></i> Iniciar Sesión
                </h3>

                <div class="mb-3">
                    <label for="txtEmail" class="form-label">Usuario</label>
                    <input type="email" class="form-control" name="txtEmail" id="txtEmail"
                        placeholder="Ingrese su correo" required autofocus spellcheck="false">
                </div>

                <div class="mb-3">
                    <label for="txtPassword" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="txtPassword" id="txtPassword"
                        placeholder="Ingrese su contraseña" required spellcheck="false">
                </div>

                <div class="mb-3 text-end">
                    <a href="#" data-bs-toggle="flip" class="semibold-text">¿Olvidaste tu contraseña?</a>
                </div>

                <div id="alertLogin" class="text-center"></div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-box-arrow-in-right me-2 fs-5"></i> Iniciar Sesión
                    </button>
                </div>
            </form>

            <!-- Formulario de recuperación de contraseña -->
            <form id="formRecetPass" name="formRecetPass" class="forget-form" action="#" method="POST" autocomplete="on">
                <h3 class="login-head">
                    <i class="bi bi-person-fill-lock"></i> ¿Olvidaste tu contraseña?
                </h3>

                <div class="mb-3">
                    <label for="txtEmailReset" class="form-label">Correo electrónico</label>
                    <input type="email" id="txtEmailReset" name="txtEmailReset" class="form-control"
                        placeholder="Ingrese su correo" required spellcheck="false">
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-unlock me-2 fs-5"></i> Reiniciar
                    </button>
                </div>

                <div class="mt-3 text-center">
                    <a href="#" data-bs-toggle="flip" class="semibold-text">
                        <i class="bi bi-chevron-left me-1"></i> Iniciar sesión
                    </a>
                </div>
            </form>
        </div>
    </section>

    <script>
        const base_url = "<?= base_url(); ?>";
    </script>

    <script src="<?= media(); ?>/js/jquery-3.7.0.min.js" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <script src="<?= media(); ?>/js/main.js" defer></script>
    <script src="<?= media(); ?>/js/<?= htmlspecialchars($data['page_functions_js'], ENT_QUOTES, 'UTF-8'); ?>" defer></script>
</body>
</html>
