// Abrir modal para nuevo rol
function openModal() {
    const idRol = document.querySelector('#idRol');
    const modalHeader = document.querySelector('.modal-header');
    const btnActionForm = document.querySelector('#btnActionForm');
    const btnText = document.querySelector('#btnText');
    const titleModal = document.querySelector('#titleModal');
    const formRol = document.querySelector("#formRol");

    if (idRol && modalHeader && btnActionForm && btnText && titleModal && formRol) {
        idRol.value = "";
        modalHeader.classList.replace("headerUpdate", "headerRegister");
        btnActionForm.classList.replace("btn-info", "btn-primary");
        btnText.innerHTML = "Guardar";
        titleModal.innerHTML = "Nuevo Rol";
        formRol.reset();
        $('#modalFormRol').modal('show');
    } else {
        console.error("Algunos elementos del modal no se encontraron.");
    }
}

// Inicializar DataTable
function initializeDataTable() {
    return $('#tableRoles').DataTable({
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
        'dom': "lBfrtip",
        'buttons': [
            {
                extend: "copyHtml5",
                text: "<i class='far fa-copy'></i> Copiar",
                titleAttr: "Copiar",
                className: "btn btn-secondary"
            },
            {
                extend: "excelHtml5",
                text: "<i class='fas fa-file-excel'></i> Excel",
                titleAttr: "Exportar a Excel",
                className: "btn btn-success"
            },
            {
                extend: "pdfHtml5",
                text: "<i class='fas fa-file-pdf'></i> PDF",
                titleAttr: "Exportar a PDF",
                className: "btn btn-danger"
            },
            {
                extend: "csvHtml5",
                text: "<i class='fas fa-file-csv'></i> CSV",
                titleAttr: "Exportar a CSV",
                className: "btn btn-info"
            }
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "desc"]]
    });
}

// Manejar envío de formulario de nuevo rol
function handleFormSubmission(form, tableRoles) {
    form.addEventListener('submit', function (e) {
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

// Manejar clics en la tabla
function handleTableActions(tableRolesElement, tableRoles) {
    tableRolesElement.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('btnEditRol')) {
            handleEditRol(e.target);
        }

        if (e.target && e.target.classList.contains('btnDelRol')) {
            handleDeleteRol(e.target, tableRoles);
        }

        if (e.target && e.target.classList.contains('btnPermisosRol')) {
            const idrol = e.target.getAttribute("rl");
            fntPermisos(idrol);
        }
    });
}

// Editar rol
function handleEditRol(target) {
    $('#modalFormRol').modal('show');

    const modalHeader = document.querySelector('.modal-header');
    const btnActionForm = document.querySelector('#btnActionForm');
    const btnText = document.querySelector('#btnText');
    const titleModal = document.querySelector("#titleModal");
    const idrol = target.getAttribute("rl");

    if (modalHeader) modalHeader.classList.replace("headerRegister", "headerUpdate");
    if (btnActionForm) btnActionForm.classList.replace("btn-primary", "btn-info");
    if (btnText) btnText.innerHTML = "Actualizar";
    if (titleModal) titleModal.innerHTML = "Actualizar Rol";

    const ajaxUrl = base_url + '/Roles/getRol/' + idrol;

    fetch(ajaxUrl)
        .then(response => response.json())
        .then(objData => {
            if (objData.status) {
                document.querySelector("#idRol").value = objData.data.idrol;
                document.querySelector("#txtNombre").value = objData.data.nombrerol;
                document.querySelector("#txtDescripcion").value = objData.data.descripcion;

                // Corregimos la forma de establecer el estado en el select
                const listStatus = document.querySelector("#listStatus");
                if (listStatus) {
                    listStatus.innerHTML = `
                        <option value="1" ${objData.data.status == 1 ? 'selected' : ''}>Activo</option>
                        <option value="2" ${objData.data.status == 2 ? 'selected' : ''}>Inactivo</option>
                    `;
                }
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
function handleDeleteRol(target, tableRoles) {
      Swal.fire({
        title: "Eliminar Rol",
        text: "¿Realmente quiere eliminar el Rol?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + '/Roles/delRol/';
            var strData = "idrol=" + idrol;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    var objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        Swal.fire("Eliminar!", objData.msg, "success");
                        tableRoles.api().ajax.reload(function() {
                            fntEditRol();
                            fntDelRol();
                            fntPermisos();
                        });
                    } else {
                        Swal.fire("Atención!", objData.msg, "error");
                    }
                }
            }
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire("Cancelado", "El rol está a salvo :)", "error");
        }
    });
}

// Gestionar permisos de un rol
function fntPermisos(idrol) {
    const ajaxUrl = base_url + '/Permisos/getPermisosRol/' + idrol;

    fetch(ajaxUrl)
        .then(response => response.text())
        .then(data => {
            const contentAjax = document.querySelector('#contentAjax');
            if (contentAjax) {
                contentAjax.innerHTML = data;
                $('.modalPermisos').modal('show');
                const formPermisos = document.querySelector('#formPermisos');
                if (formPermisos) {
                    formPermisos.addEventListener('submit', fntSavePermisos, false);
                } else {
                    console.error("No se encontró el formulario #formPermisos.");
                }
            } else {
                console.error("El elemento #contentAjax no existe en el DOM.");
            }
        })
        .catch(error => {
            console.error("Error al obtener los permisos del rol:", error);
        });
}

// Guardar permisos de un rol
function fntSavePermisos(e) {
    e.preventDefault();

    const formPermisos = document.querySelector('#formPermisos');

    if (!formPermisos) {
        console.error("El formulario #formPermisos no existe.");
        Swal.fire("Error", "No se encontró el formulario de permisos.", "error");
        return;
    }

    const ajaxUrl = base_url + '/Permisos/setPermisos';
    const formData = new FormData(formPermisos);

    fetch(ajaxUrl, {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.status) {
            Swal.fire("Éxito", data.msg, "success");
            $('.modalPermisos').modal('hide');
        } else {
            Swal.fire("Error", data.msg, "error");
        }
    })
    .catch(error => {
        console.error("Error al guardar los permisos:", error);
        Swal.fire("Error", "Hubo un problema al guardar los permisos.", "error");
    });
}

// Enviar solicitudes AJAX
function sendRequest(method, url, data = null) {
    return fetch(url, {
        method,
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: data
    }).then(response => response.json());
}

// Inicializar eventos al cargar el DOM
document.addEventListener('DOMContentLoaded', function () {
    const tableRoles = initializeDataTable();
    const formRol = document.querySelector('#formRol');
    const tableRolesElement = document.querySelector('#tableRoles');

    if (formRol) handleFormSubmission(formRol, tableRoles);
    if (tableRolesElement) handleTableActions(tableRolesElement, tableRoles);
});
