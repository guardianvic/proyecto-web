<!-- Base URL -->
<script>
    const base_url = "<?= base_url(); ?>";
</script>

<!-- jQuery (necesario para muchos plugins) -->
<script src="<?= media(); ?>/js/jquery-3.7.0.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


<!-- DataTables: Plugins de jQuery -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>


<!-- JS de Bootstrap Select -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js"></script>


<!-- SweetAlert: Para notificaciones -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Scripts personalizados -->
<script src="<?= media(); ?>/js/main.js"></script> <!-- Configuración global -->
<script src="<?= media(); ?>/js/functions_admin.js"></script> <!-- Funciones generales -->

<script src="<?= htmlspecialchars(media(), ENT_QUOTES, 'UTF-8'); ?>/js/<?= htmlspecialchars($data['page_functions_js'] ?? 'default.js', ENT_QUOTES, 'UTF-8'); ?>"></script>



<!-- Manejo de errores de carga de scripts -->
  <script>
    window.addEventListener('error', function (e) {
        if (e.target.tagName === 'SCRIPT') {
            console.error('Error al cargar el script:', e.target.src);
        }
    });
</script>
