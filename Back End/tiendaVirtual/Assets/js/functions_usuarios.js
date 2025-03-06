var tableUsuarios;

document.addEventListener('DOMContentLoaded', function () {
    // Inicialización de la tabla de usuarios con DataTable
    tableUsuarios = $('#tableUsuarios').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": base_url + "/Usuarios/getUsuarios",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idpersona" },
            { "data": "nombres" },
            { "data": "apellidos" },
            { "data": "email_user" },
            { "data": "telefono" },
            { "data": "nombrerol" },
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
        "iDisplayLength": 05,
        "order": [[0, "desc"]]
    });

    // Formulario de usuario: crear/actualizar
    const formUsuario = document.querySelector("#formUsuario");
    if (formUsuario) {
        formUsuario.onsubmit = function (e) {
            e.preventDefault();

            if (!checkInvalidFields()) {
                return false;
            }

            const strIdentificacion = document.querySelector('#txtIdentificacion').value.trim();
            const strNombre = document.querySelector('#txtNombre').value.trim();
            const strApellido = document.querySelector('#txtApellido').value.trim();
            const strEmail = document.querySelector('#txtEmail').value.trim();
            const intTelefono = document.querySelector('#txtTelefono').value.trim();
            const intTipousuario = document.querySelector('#listRolid').value.trim();
            const strPassword = document.querySelector('#txtPassword').value.trim();
            const intStatus = document.querySelector('#listStatus').value;

            if (strIdentificacion === '' || strNombre === '' || strApellido === '' ||
                strEmail === '' || intTelefono === '' || intTipousuario === '') {
                Swal.fire("Atención", "Todos los campos son obligatorios .", "error");
                return false;
            }

            // Función para verificar si hay campos inválidos
            function checkInvalidFields() {
                const elementsValid = document.querySelectorAll(".valid");
                const invalidFields = Array.from(elementsValid).filter(el => el.classList.contains('is-invalid'));

                if (invalidFields.length > 0) {
                    const invalidFieldNames = invalidFields.map(el => el.name || el.id || 'Campo no identificado');
                    Swal.fire({
                        title: "Atención",
                        text: `Por favor verifique los campos en rojo`,
                        icon: "error"
                    });
                    return false;
                }
                return true;
            }

            const request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            const ajaxUrl = base_url + '/Usuarios/setUsuario';
            const formData = new FormData(formUsuario);
            request.open("POST", ajaxUrl, true);
            request.send(formData);

            request.onreadystatechange = function () {
                
                if (request.readyState === 4 && request.status === 200) {
                    const objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('modalFormUsuario'));
                        modal.hide();
                        formUsuario.reset();
                        Swal.fire("Usuarios", objData.msg, "success");
                        tableUsuarios.ajax.reload();
                    } else {
                        Swal.fire("Error", objData.msg, "error");
                    }
                }
            };
        };
    }

    // Cargar roles de usuario para el selector
    function fntRolesUsuario() {
        const listRolid = document.querySelector('#listRolid');
        if (listRolid) {
            const ajaxUrl = base_url + '/Roles/getSelectRoles';
            const request = new XMLHttpRequest();
            request.open("GET", ajaxUrl, true);
            request.send();

            request.onreadystatechange = function () {
                if (request.readyState === 4 && request.status === 200) {
                    listRolid.innerHTML = request.responseText;
                    listRolid.value = 1;
                    if ($.fn.selectpicker) {
                        $('#listRolid').selectpicker('refresh');
                    }
                }
            };
        }
    }

    // Función para ver detalles de un usuario
    function fntViewUsuario(idpersona) {
        if (!idpersona) {
            Swal.fire("Error", "No se pudo identificar al usuario.", "error");
            return;
        }

        const request = new XMLHttpRequest();
        const ajaxUrl = base_url + '/Usuarios/getUsuario/' + idpersona;
        request.open("GET", ajaxUrl, true);
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState === 4) {
                if (request.status === 200) {
                    try {
                        const objData = JSON.parse(request.responseText);
                        if (objData.status) {
                            let estadoUsuario = objData.data.status == 1
                                ? '<span class="badge bg-success rounded-pill">Activo</span>'
                                : '<span class="badge bg-danger rounded-pill">Inactivo</span>';

                            // Mostrar los detalles en el modal
                            document.querySelector("#celIdentificacion").innerHTML = objData.data.identificacion;
                            document.querySelector("#celNombre").innerHTML = objData.data.nombres;
                            document.querySelector("#celApellido").innerHTML = objData.data.apellidos;
                            document.querySelector("#celTelefono").innerHTML = objData.data.telefono;
                            document.querySelector("#celEmail").innerHTML = objData.data.email_user;
                            document.querySelector("#celTipoUsuario").innerHTML = objData.data.nombrerol;
                            document.querySelector("#celEstado").innerHTML = estadoUsuario;
                            document.querySelector("#celFechaRegistro").innerHTML = objData.data.fechaRegistro;

                            // Mostrar el modal con Bootstrap 5
                            const modal = new bootstrap.Modal(document.getElementById('modalViewUser'));
                            modal.show();
                        } else {
                            Swal.fire("Error", objData.msg, "error");
                        }
                    } catch (error) {
                        Swal.fire("Error", "Error al procesar la respuesta del servidor.", "error");
                    }
                } else {
                    Swal.fire("Error", "No se pudo completar la solicitud. Intente nuevamente.", "error");
                }
            }
        };

        request.onerror = function () {
            Swal.fire("Error", "No se pudo conectar al servidor. Intente nuevamente.", "error");
        };
    }

    // Función para editar un usuario
    function fntEditUsuario(idpersona) {
        document.querySelector('#modalTitle').innerHTML = "Actualizar Usuario";
        document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
        document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
        document.querySelector('#btnText').innerHTML = "Actualizar";

        const request = new XMLHttpRequest();
        const ajaxUrl = base_url + '/Usuarios/getUsuario/' + idpersona;
        request.open("GET", ajaxUrl, true);
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState === 4) {
                if (request.status === 200) {
                    try {
                        const objData = JSON.parse(request.responseText);
                        if (objData.status) {
                            // Llenar los campos del modal con los datos del usuario
                            document.querySelector("#idUsuario").value = objData.data.idpersona;
                            document.querySelector("#txtIdentificacion").value = objData.data.identificacion;
                            document.querySelector("#txtNombre").value = objData.data.nombres;
                            document.querySelector("#txtApellido").value = objData.data.apellidos;
                            document.querySelector("#txtTelefono").value = objData.data.telefono;
                            document.querySelector("#txtEmail").value = objData.data.email_user;
                            document.querySelector("#listRolid").value = objData.data.idrol;
                            document.querySelector("#listStatus").value = objData.data.status;

                            // Mostrar el modal de edición
                            const modal = new bootstrap.Modal(document.getElementById('modalFormUsuario'));
                            modal.show();
                        } else {
                            Swal.fire("Error", objData.msg, "error");
                        }
                    } catch (error) {
                        Swal.fire("Error", "Error al procesar la respuesta del servidor.", "error");
                    }
                } else {
                    Swal.fire("Error", "No se pudo completar la solicitud. Intente nuevamente.", "error");
                }
            }
        };

        request.onerror = function () {
            Swal.fire("Error", "No se pudo conectar al servidor. Intente nuevamente.", "error");
        };
    }

    // Función para eliminar un usuario
    function fntDelUsuario(idUsuario, tableUsuarios) {
    Swal.fire({
        title: "Eliminar Usuario",
        text: "¿Realmente quiere eliminar el usuario?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, eliminar!",
        cancelButtonText: "No, cancelar!",
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            let request = new XMLHttpRequest();
            let ajaxUrl = base_url + "/Usuarios/delUsuario";
            let strData = "idUsuario=" + idUsuario;

            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);

            request.onreadystatechange = function () {
                if (request.readyState === 4 && request.status === 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        Swal.fire("Eliminado!", objData.msg, "success");
                        tableUsuarios.api().ajax.reload();
                    } else {
                        Swal.fire("Atención!", objData.msg, "error");
                    }
                }
            };
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire("Cancelado", "El usuario está a salvo :)", "error");
        }
    });
}

    // Reasignar eventos después de redibujar la tabla
    tableUsuarios.on('draw', function () {
        document.querySelectorAll('.btnViewUsuario').forEach(function (btnViewUsuario) {
            btnViewUsuario.addEventListener('click', function () {
                const idpersona = btnViewUsuario.getAttribute('data-id');
                fntViewUsuario(idpersona);
            });
        });

        document.querySelectorAll('.btnEditUsuario').forEach(function (btnEditUsuario) {
            btnEditUsuario.addEventListener('click', function () {
                const idpersona = btnEditUsuario.getAttribute('data-id');
                fntEditUsuario(idpersona);
            });
        });

        document.querySelectorAll('.btnDelUsuario').forEach(function (btnDelUsuario) {
            btnDelUsuario.addEventListener('click', function () {
                const idpersona = btnDelUsuario.getAttribute('data-id');
                fntDelUsuario(idpersona);
            });
        });
    });

    // Cargar roles de usuario para el selector
    fntRolesUsuario();

    // Función para abrir el modal para crear un nuevo usuario
    window.openModal = function () {
        const modal = new bootstrap.Modal(document.getElementById('modalFormUsuario'));
        document.querySelector('#modalTitle').innerHTML = "Nuevo Usuario";
        document.querySelector('#btnText').innerHTML = "Guardar";
        const btnActionForm = document.querySelector('#btnActionForm');
        btnActionForm.classList.remove("btn-info");
        btnActionForm.classList.add("btn-primary");
        document.querySelector('#idUsuario').value = ''; 
        document.querySelector('#formUsuario').reset();
        modal.show();
    };
});
