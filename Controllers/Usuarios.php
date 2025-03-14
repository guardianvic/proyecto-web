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
    if ($_POST) {
        if (
            empty($_POST['txtIdentificacion']) ||
            empty($_POST['txtNombre']) ||
            empty($_POST['txtApellido']) ||
            empty($_POST['txtTelefono']) ||
            empty($_POST['txtEmail']) ||
            empty($_POST['listRolid']) ||
            empty($_POST['listStatus'])
        ) {
            $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
        } else {
            $idUsuario = intval($_POST['idUsuario']);
            $strIdentificacion = strClean($_POST['txtIdentificacion']);
            $strNombre = ucwords(strClean($_POST['txtNombre']));
            $strApellido = ucwords(strClean($_POST['txtApellido']));
            $strTelefono = intval(strClean($_POST['txtTelefono']));
            $strEmail = strtolower(strClean($_POST['txtEmail']));
            $intTipoId = intval(strClean($_POST['listRolid']));
            $intStatus = intval(strClean($_POST['listStatus']));
            $request_user = "";

            if ($idUsuario == 0) {
                // Nuevo usuario
                $option = 1;
                $strPassword = empty($_POST['txtPassword']) ? hash("SHA256", passGenerator()) : hash("SHA256", $_POST['txtPassword']);

                $request_user = $this->model->insertUsuario(
                    $strIdentificacion,
                    $strNombre,
                    $strApellido,
                    $strTelefono,
                    $strEmail,
                    $strPassword,
                    $intTipoId,
                    $intStatus
                );

            } else {
                // Actualización de usuario
                $option = 2;
                $strPassword = empty($_POST['txtPassword']) ? "" : hash("SHA256", $_POST['txtPassword']);

                $request_user = $this->model->updateUsuario(
                    $idUsuario,
                    $strIdentificacion,
                    $strNombre,
                    $strApellido,
                    $strTelefono,
                    $strEmail,
                    $strPassword,
                    $intTipoId,
                    $intStatus
                );
            }

            if ($request_user > 0) {
                $arrResponse = array('status' => true, 'msg' => ($option == 1) ? 'Datos guardados correctamente.' : 'Datos actualizados correctamente.');
            } elseif ($request_user == 'exist') {
                $arrResponse = array('status' => false, 'msg' => '¡Atención! El email o la identificación ya existe, ingrese otro.');
            } else {
                $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
            }
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
    }
    die();
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


