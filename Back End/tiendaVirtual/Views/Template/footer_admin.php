<!-- Base URL -->
<script>
    const base_url = "<?= base_url(); ?>";
</script>

<!-- jQuery (necesario para muchos plugins) -->
<script src="<?= media(); ?>/js/jquery-3.7.0.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>


<!-- DataTables: Plugins de jQuery -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- SweetAlert: Para notificaciones -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Scripts personalizados -->
<script src="<?= media(); ?>/js/main.js"></script> <!-- Configuración global -->
<script src="<?= media(); ?>/js/functions_admin.js"></script> <!-- Funciones generales -->
<script src="<?= media(); ?>/js/functions_roles.js"></script> <!-- Funciones específicas -->

<!-- Manejo de errores de carga de scripts -->
<script>
    window.addEventListener('error', function (e) {
        if (e.target.tagName === 'SCRIPT') {
            console.error('Error al cargar el script:', e.target.src);
        }
    });
</script>
