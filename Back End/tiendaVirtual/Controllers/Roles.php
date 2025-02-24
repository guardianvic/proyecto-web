<?php

class Roles extends Controllers
{
    public function __construct()
    {
        
        
        parent::__construct();
    }

    // Método que muestra la vista de roles
    public function Roles()
    {
        $data = [
            'page_id' => 3,
            'page_tag' => "Roles Usuario",
            'page_name' => "rol_usuario",
            'page_title' => "Roles Usuario - <small>Tienda Virtual</small>",
            'page_functions_js' => "functions_roles.js"
        ];

        $this->views->getView($this, "roles", $data);
    }

    // Obtener todos los roles
    public function getRoles()
    {
        $arrData = $this->model->selectRoles();

        for ($i = 0; $i < count($arrData); $i++) {
            
            $arrData[$i]['status'] = $arrData[$i]['status'] == 1
                ? '<span class="badge bg-success btn-sm">Activo</span>'
                : '<span class="badge bg-danger btn-sm">Inactivo</span>';

            // Opciones de acción
            $arrData[$i]['options'] = '
            <div class="text-center">
                <button class="btn btn-secondary btn-sm btnPermisosRol" rl="' . htmlspecialchars($arrData[$i]['idrol']) . '" title="Permisos"><i class="fas fa-key"></i></button>
                <button class="btn btn-success btn-sm btnEditRol" rl="' . htmlspecialchars($arrData[$i]['idrol']) . '" title="Editar"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
                <button class="btn btn-danger btn-sm btnDelRol" rl="' . htmlspecialchars($arrData[$i]['idrol']) . '" title="Eliminar"><i class="far fa-trash-alt"></i></button>
            </div>';
        }

        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }

   
        public function getSelectRoles()
        {
            $htmlOptions = "";
            $arrData = $this->model->selectRoles();
            if(count($arrData) > 0 ){
                for ($i=0; $i < count($arrData); $i++) { 
                    if($arrData[$i]['status'] == 1 ){
                    $htmlOptions .= '<option value="'.$arrData[$i]['idrol'].'">'.$arrData[$i]['nombrerol'].'</option>';
                    }
                }
            }
            echo $htmlOptions;
            die();      
        }


    // Obtener un rol específico
    public function getRol(int $idrol)
    {
        $intIdrol = intval(strClean($idrol));
        if ($intIdrol > 0) {
            $arrData = $this->model->selectRol($intIdrol);

            $arrResponse = empty($arrData)
                ? ['status' => false, 'msg' => 'Datos no encontrados.']
                : ['status' => true, 'data' => $arrData];

            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    // Crear o actualizar un rol
    public function setRol()
    {
        // Validar datos del formulario
        $intIdrol = isset($_POST['idRol']) ? intval($_POST['idRol']) : 0;
        $strRol = isset($_POST['txtNombre']) ? strClean($_POST['txtNombre']) : '';
        $strDescipcion = isset($_POST['txtDescripcion']) ? strClean($_POST['txtDescripcion']) : '';
        $intStatus = isset($_POST['listStatus']) ? intval($_POST['listStatus']) : 0;

        if ($strRol === '' || $strDescipcion === '' || $intStatus === 0) {
            echo json_encode(['status' => false, 'msg' => 'Todos los campos son obligatorios.'], JSON_UNESCAPED_UNICODE);
            die();
        }

        // Crear o actualizar
        if ($intIdrol == 0) {
            $request_rol = $this->model->insertRol($strRol, $strDescipcion, $intStatus);
            $option = 1;
        } else {
            $request_rol = $this->model->updateRol($intIdrol, $strRol, $strDescipcion, $intStatus);
            $option = 2;
        }

        // Respuesta
        if ($request_rol > 0) {
            $arrResponse = [
                'status' => true,
                'msg' => $option == 1 ? 'Datos guardados correctamente.' : 'Datos actualizados correctamente.'
            ];
        } elseif ($request_rol == 'exist') {
            $arrResponse = ['status' => false, 'msg' => '¡Atención! El Rol ya existe.'];
        } else {
            $arrResponse = ['status' => false, 'msg' => 'No es posible almacenar los datos.'];
        }

        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }

    // Eliminar un rol
    public function delRol()
    {
        if ($_POST) {
            $intIdrol = intval($_POST['idrol']);
            $requestDelete = $this->model->deleteRol($intIdrol);

            // Respuesta
            if ($requestDelete == 'ok') {
                $arrResponse = ['status' => true, 'msg' => 'Se ha eliminado el Rol.'];
            } elseif ($requestDelete == 'exist') {
                $arrResponse = ['status' => false, 'msg' => 'No es posible eliminar un Rol asociado a usuarios.'];
            } else {
                $arrResponse = ['status' => false, 'msg' => 'Error al eliminar el Rol.'];
            }

            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}

?>
