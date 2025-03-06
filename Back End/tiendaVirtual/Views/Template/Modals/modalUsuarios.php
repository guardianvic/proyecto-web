<!-- Modal Nuevo Usuario -->
<div class="modal fade" id="modalFormUsuario" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="modalTitle">Nuevo Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formUsuario" name="formUsuario" class="needs-validation" novalidate>
                    <input type="hidden" id="idUsuario" name="idUsuario" value="">
                    <p class="text-primary">Todos los campos son obligatorios.</p>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="txtIdentificacion" class="form-label">Identificación</label>
                            <input type="text" class="form-control" id="txtIdentificacion" name="txtIdentificacion" required onkeypress="return controlTag(event);">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="txtNombre" class="form-label">Nombres</label>
                            <input type="text" class="form-control valid validText" id="txtNombre" name="txtNombre" required>
                        </div>
                        <div class="col-md-6">
                            <label for="txtApellido" class="form-label">Apellidos</label>
                            <input type="text" class="form-control valid validText" id="txtApellido" name="txtApellido" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="txtTelefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" required onkeypress="return controlTag(event);">
                        </div>
                        <div class="col-md-6">
                            <label for="txtEmail" class="form-label">Email</label>
                            <input type="email" class="form-control valid validEmail" id="txtEmail" name="txtEmail" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="listRolid" class="form-label">Tipo usuario</label>
                            <select class="form-control selectpicker" data-live-search="true" id="listRolid" name="listRolid">
                                <!-- Opciones dinámicas -->
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="listStatus" class="form-label">Estado</label>
                            <select class="form-control " id="listStatus" name="listStatus" required>
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="txtPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="txtPassword" name="txtPassword">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button id="btnActionForm" class="btn btn-success me-2" type="submit">
                            <i class="bi bi-floppy-fill fs-6"></i>
                            <span id="btnText">Guardar</span>
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            <i class="fas fa-sign-out-alt"></i> Cerrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Modal Nuevo Usuario -->
<div class="modal fade" id="modalViewUser" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="modalTitle">Datos del usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Identificación:</td>
                            <td id="celIdentificacion">6546544654:</td>
                        </tr>
                        <tr>
                            <td>Nombres:</td>
                            <td id="celNombre">Jacob</td>
                        </tr>
                        <tr>
                            <td>Apellidos:</td>
                            <td id="celApellido">Jacob</td>
                        </tr>
                        <tr>
                            <td>Teléfono:</td>
                            <td id="celTelefono">Larry</td>
                        </tr>
                         <tr>
                            <td>Email (Usuario):</td>
                            <td id="celEmail">Larry</td>
                        </tr>
                        <tr>
                            <td>Tipo Usuario:</td>
                            <td id="celTipoUsuario">Larry</td>
                        </tr>
                        <tr>
                            <td>Estado:</td>
                            <td id="celEstado">Larry</td>
                        </tr>
                        <tr>
                            <td>Fecha Registro:</td>
                            <td id="celFechaRegistro">Larry</td>
                        </tr> 
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

