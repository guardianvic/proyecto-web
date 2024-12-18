// Abrir modal para nuevo rol
function openModal() {
    const idRol = document.querySelector('#idRol');
    const modalHeader = document.querySelector('.modal-header');
    const btnActionForm = document.querySelector('#btnActionForm');
    const btnText = document.querySelector('#btnText');
    const titleModal = document.querySelector('#titleModal');
    const formRol = document.querySelector("#formRol");

    // Verificamos si los elementos existen antes de manipularlos
    if (idRol && modalHeader && btnActionForm && btnText && titleModal && formRol) {
        // Limpiar el formulario
        idRol.value = "";
        modalHeader.classList.replace("headerUpdate", "headerRegister");
        btnActionForm.classList.replace("btn-info", "btn-primary");
        btnText.innerHTML = "Guardar";
        titleModal.innerHTML = "Nuevo Rol";
        formRol.reset();

        // Mostrar modal
        $('#modalFormRol').modal('show');
    } else {
        console.error("Algunos elementos del modal no se encontraron.");
    }
}

// Inicializar DataTable al cargar el DOM
document.addEventListener('DOMContentLoaded', function () {
    const tableRoles = $('#tableRoles').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": base_url + "/Roles/getRoles",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idrol" },
            { "data": "nombrerol" },
            { "data": "descripcion" },
            { "data": "status" },
            { "data": "options" }
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "desc"]]
    });

    // Evento para manejar el envío del formulario de nuevo rol
    const formRol = document.querySelector('#formRol');
    if (formRol) {
        formRol.addEventListener('submit', function (e) {
            e.preventDefault();

            const ajaxUrl = base_url + '/Roles/setRol';
            const formData = new FormData(this);

            fetch(ajaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    $('#modalFormRol').modal('hide');
                    Swal.fire("Éxito", data.msg, "success");
                    tableRoles.ajax.reload();
                } else {
                    Swal.fire("Error", data.msg, "error");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire("Error", "No se pudo completar la solicitud.", "error");
            });
        });
    }

    // Delegar eventos para manejar clics en los botones dinámicos
    const tableRolesElement = document.querySelector('#tableRoles');
    if (tableRolesElement) {
        tableRolesElement.addEventListener('click', function (e) {
            // Editar rol
            if (e.target && e.target.classList.contains('btnEditRol')) {
                $('#modalFormRol').modal('show');

                const modalHeader = document.querySelector('.modal-header');
                if (modalHeader) {
                    modalHeader.classList.replace("headerRegister", "headerUpdate");
                }

                const btnActionForm = document.querySelector('#btnActionForm');
                if (btnActionForm) {
                    btnActionForm.classList.replace("btn-primary", "btn-info");
                }

                const btnText = document.querySelector('#btnText');
                if (btnText) {
                    btnText.innerHTML = "Actualizar";
                }

                const idrol = e.target.getAttribute("rl");
                const ajaxUrl = base_url + '/Roles/getRol/' + idrol;

                fetch(ajaxUrl)
                    .then(response => response.json())
                    .then(objData => {
                        if (objData.status) {
                            document.querySelector("#idRol").value = objData.data.idrol;
                            document.querySelector("#txtNombre").value = objData.data.nombrerol;
                            document.querySelector("#txtDescripcion").value = objData.data.descripcion;

                            document.querySelector("#listStatus").innerHTML = `
                                <option value="${objData.data.status}">${objData.data.status == 1 ? 'Activo' : 'Inactivo'}</option>
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            `;
                        } else {
                            Swal.fire("Error", objData.msg, "error");
                        }
                    })
                    .catch(error => {
                        console.error("Error al obtener los datos del rol:", error);
                        Swal.fire("Error", "Hubo un problema al obtener los datos", "error");
                    });
            }

            // Eliminar rol
            if (e.target && e.target.classList.contains('btnDelRol')) {
                const idrol = e.target.getAttribute("rl");
                Swal.fire({
                    title: "Eliminar Rol",
                    text: "¿Realmente quieres eliminar el rol?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, eliminar",
                    cancelButtonText: "No, cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        const ajaxUrl = base_url + '/Roles/delRol/';
                        const data = `idrol=${idrol}`;

                        sendRequest('POST', ajaxUrl, data)
                            .then(response => {
                                if (response.status) {
                                    Swal.fire("Eliminado", response.msg, "success");
                                    tableRoles.ajax.reload();
                                } else {
                                    Swal.fire("Error", response.msg, "error");
                                }
                            })
                            .catch(error => {
                                console.error("Error al eliminar el rol:", error);
                                Swal.fire("Error", "Hubo un problema al procesar la solicitud", "error");
                            });
                    }
                });
            }

            // Abrir modal de permisos
            if (e.target && e.target.classList.contains('btnPermisosRol')) {
                $('.modalPermisos').modal('show');
            }
        });
    }
});

// Función para enviar solicitudes AJAX
function sendRequest(method, url, data = null) {
    return new Promise((resolve, reject) => {
        fetch(url, {
            method,
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: data
        })
        .then(response => response.json())
        .then(resolve)
        .catch(reject);
    });
}
