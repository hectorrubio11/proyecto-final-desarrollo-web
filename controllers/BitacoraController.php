<?php
namespace Controllers;
use Models\BitacoraModel;

class BitacoraController {
    private BitacoraModel $bitacoraModel;

    public function __construct() {
        $this->bitacoraModel = new BitacoraModel(); 
    }

    public function listar() {

        // Obtenemos todos los registros de la base de datos
        $logs = $this->bitacoraModel->listarTodos();

        // 3. VISTA: Cargamos el layout profesional
        require_once 'views/bitacora/index.php';
    }
}