<?php

class Usuarios extends Controllers
{   
    public function __construct()
    {
        parent::__construct();
    }

    public function Usuarios()
    {
        $data = [
            'page_tag' => "Usuarios",
            'page_name' => "usuarios",
            'page_title' => "Usuarios - <small>Tienda Virtual</small>",
            'page_functions_js' => "functions_usuarios.js"
        ];

        $this->views->getView($this, "usuarios", $data);
    }

    private function jsonResponse($status, $message, $data = [])
    {
        echo json_encode(["status" => $status, "msg" => $message, "data" => $data], JSON_UNESCAPED_UNICODE);
        die();
    }

    public function setUsuario()
    {
        try {
            if ($_POST) {
                if (
                    empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) ||
                    empty($_POST['txtApellido']) || empty($_POST['txtTelefono']) ||
                    empty($_POST['txtEmail']) || empty($_POST['listRolid']) ||
                    empty($_POST['listStatus'])
                ) {
                    $this->jsonResponse(false, 'Datos incompletos.');
                }

                $idUsuario = intval($_POST['idUsuario']);
                $strIdentificacion = strClean($_POST['txtIdentificacion']);
                $strNombre = ucwords(trim(strClean($_POST['txtNombre'])));
                $strApellido = ucwords(trim(strClean($_POST['txtApellido'])));
                $strEmail = strtolower(strClean($_POST['txtEmail']));
                $intTelefono = intval(strClean($_POST['txtTelefono']));
                $intTipoId = intval(strClean($_POST['listRolid']));
                $intStatus = intval(strClean($_POST['listStatus']));
                $strPassword = empty($_POST['txtPassword']) ? hash("SHA256", passGenerator()) : hash("SHA256", $_POST['txtPassword']);

                if ($idUsuario == 0) {
                    // Nuevo usuario
                    $request_user = $this->model->insertUsuario(
                        $strIdentificacion,
                        $strNombre,
                        $strApellido,
                        $intTelefono,
                        $strEmail,
                        $strPassword,
                        $intTipoId,
                        $intStatus
                    );
                } else {
                    // Obtener la contraseña actual
                    $usuarioExistente = $this->model->selectUsuario($idUsuario);
                    if (empty($_POST['txtPassword'])) {
                        $strPassword = $usuarioExistente['password']; // Mantener la misma contraseña si no se cambia
                    } else {
                        $strPassword = hash("SHA256", $_POST['txtPassword']); // Cifrar nueva contraseña
                    }

                    // Actualizar usuario
                    $request_user = $this->model->updateUsuario(
                        $idUsuario,
                        $strIdentificacion,
                        $strNombre,
                        $strApellido,
                        $intTelefono,
                        $strEmail,
                        $strPassword,
                        $intTipoId,
                        $intStatus
                    );
                }

                if ($request_user > 0) {
                    $userData = $this->model->selectUsuario($idUsuario);
                    $msg = $idUsuario == 0 ? 'Usuario creado correctamente.' : 'Usuario actualizado correctamente.';
                    $this->jsonResponse(true, $msg, $userData);
                } elseif ($request_user == 'exist') {
                    $this->jsonResponse(false, 'El email o la identificación ya existe.');
                } else {
                    $this->jsonResponse(false, 'Error al guardar los datos.');
                }
            }
        } catch (Exception $e) {
            error_log("Error en setUsuario: " . $e->getMessage());
            $this->jsonResponse(false, 'Ocurrió un error interno.');
        }
    }

    public function getUsuarios()
    {
        $arrData = $this->model->selectUsuarios();
        for ($i = 0; $i < count($arrData); $i++) {
            $arrData[$i]['status'] = $arrData[$i]['status'] == 1
            ? '<span class="badge bg-success btn-sm">Activo</span>'
            : '<span class="badge bg-danger btn-sm">Inactivo</span>';

            // Opciones de acción
            $arrData[$i]['options'] = '
            <div class="text-center">
            <button class="btn btn-info btn-sm btnViewUsuario" data-id="' . htmlspecialchars($arrData[$i]['idpersona']) . '" title="Ver usuario"><i class="fas bi-eye"></i></button>

            <button class="btn btn-success btn-sm btnEditUsuario" data-id="' . htmlspecialchars($arrData[$i]['idpersona']) . '" title="Editar usuario"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>

            <button class="btn btn-danger btn-sm btnDelUsuario" data-id="' . htmlspecialchars($arrData[$i]['idpersona']) . '" title="Eliminar usuario"><i class="fas fa-trash-alt"></i></button>
            </div>';
        }

        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getUsuario(int $idpersona)
    {
        $idusuario = intval($idpersona);
        if ($idusuario > 0) {
            $arrData = $this->model->selectUsuario($idusuario);
            if (empty($arrData)) {
                $this->jsonResponse(false, 'Datos no encontrados.');
            } else {
                $this->jsonResponse(true, 'Datos encontrados.', $arrData);
            }
        }
        die();
    }

    public function delUsuario()
    {
        if ($_POST) {
            $intIdpersona = intval($_POST['idUsuario']);
            $requestDelete = $this->model->deleteUsuario($intIdpersona);

            // Respuesta
            if ($requestDelete == 'ok') {
                $arrResponse = ['status' => true, 'msg' => 'Se ha eliminado el Usuario.'];
            } elseif ($requestDelete == 'exist') {
                $arrResponse = ['status' => false, 'msg' => 'No es posible eliminar el usuario.'];
            } else {
                $arrResponse = ['status' => false, 'msg' => 'Error al eliminar el Usuario.'];
            }

            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
?>
