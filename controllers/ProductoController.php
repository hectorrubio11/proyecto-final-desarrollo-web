<?php
namespace Controllers;

use Models\ProductoModel;
use Models\BitacoraModel;

class ProductoController{
    private ProductoModel $productoModel;
    private BitacoraModel $bitacora;
    private $usuario;

    public function __construct()
    {
        $this->productoModel = new ProductoModel();
        $this->bitacora = new BitacoraModel();
    }

    public function verificarSesion(): void{
        if (session_status() === PHP_SESSION_NONE){
            session_start();
        }

        if (!isset($_SESSION['admin'])){
            header('Location: '. BASE_URL .'login');
            exit;
        }

        $this->usuario = $_SESSION['admin']['username'] ?? 'Invitado';
    }

    public function index(): void{
        $this->verificarSesion();
        $productos = $this->productoModel->obtenerTodos();
        require_once __DIR__ . '/../views/productos/index.php';
    }

    public function create(): void{
        $this->verificarSesion();
        require_once __DIR__ . '/../views/productos/create.php';
    }

    public function store(): void {
        $this->verificarSesion();
        $this->validarCSRF();

        $data = [
            'sku' => trim($_POST['sku'] ?? ''),
            'nombre' => trim($_POST['nombre'] ?? ''),
            'descripcion' => trim($_POST['descripcion'] ?? ''),
            'precio_compra' => trim($_POST['precio_compra'] ?? ''),
            'precio_venta' => trim($_POST['precio_venta'] ?? ''),
            'existencia' => trim($_POST['existencia'] ?? '')
        ];

        if (
            $data['sku'] === '' ||
            $data['nombre'] === '' ||
            $data['descripcion'] === '' ||
            $data['precio_compra'] === '' ||
            $data['precio_venta'] === '' ||
            $data['existencia'] === ''
        ){
            $_SESSION['error'] = 'Todos los campos son obligatorios.';
            header('Location: '. BASE_URL .'productos/create');
            exit;
        }

        if (!is_numeric($data['precio_compra']) || !is_numeric($data['precio_venta'])
        || !is_numeric($data['existencia'])) {
            $_SESSION['error'] = 'Precio de compra, precio de venta y 
            existencia deben ser numéricos.';
            header('Location: '. BASE_URL .'productos/create');
            exit;
        }

        if ((float)$data['precio_compra'] < 0 || (float)$data['precio_venta'] < 0 ||
        (int)$data['existencia'] < 0 ){
            $_SESSION['error'] = 'No se permiten valores negativos.';
            header('Location: '. BASE_URL .'productos/create');
            exit;
        }

        // Validar que el precio de venta sea mayor o igual al de compra
        if ((float)$data['precio_venta'] < (float)$data['precio_compra']) {
            $_SESSION['error'] = 'El precio de venta no puede ser menor al precio de compra.';
            header('Location: '. BASE_URL .'productos/create');
            exit;
        }

        // Validar que el stock no sea negativo
        if ((int)$data['existencia'] < 0) {
            $_SESSION['error'] = 'La existencia no puede ser menor a cero.';
            header('Location: '. BASE_URL .'productos/create');
            exit;
        }

        // Validar SKU unico
        if ($this->productoModel->existeSku($data['sku'])) {
            $_SESSION['error'] = 'El SKU ingresado ya está registrado.';
            header('Location: '. BASE_URL .'productos/create');
            exit;
        }

        // empezar diciendo que no hay foto por si no suben nada
        $nombreImagen = null;
        // revisar si mandaron un archivo y si no tiene errores de subida
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            // sacar la extension de la foto (jpg, png, etc.)
            $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
            // armar un nombre unico mezclando la hora y un id raro para que no se repitan
            $nombreImagen = time() . '_' . uniqid() . '.' . $ext;
            // decirle a donde queremos mandar la foto guardada (carpeta img)
            $rutaDestino = __DIR__ . '/../img/' . $nombreImagen;
            // mover el archivo temporal que te da php a nuestra carpeta real
            move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino);
        }
        // meter el nombre final de la foto al array que va para la base de datos
        $data['imagen'] = $nombreImagen;

        if ($this->productoModel->crear($data)){
            $this->bitacora->log($this->usuario, "Producto ". $data['nombre'] ." agregado");
            $_SESSION['success'] = 'Producto registrado correctamente.';
        } else {
            $this->bitacora->log($this->usuario, "FALLO al agregar nuevo producto");
            $_SESSION['error'] = 'No fue posible registrar el producto';
        }

        header('Location: '. BASE_URL .'productos');
        exit;
    }

    public function edit(): void{
        $this->verificarSesion();
        $id = (int)($_GET['id'] ?? 0);
        $producto = $this->productoModel->obtenerPorId($id);

        if (!$producto){
            $_SESSION['error'] = 'Producto no encontrado.';
            header('Location: '. BASE_URL .'productos');
            exit;
        }

        require_once __DIR__ . '/../views/productos/edit.php';
    }

    public function update(): void{
        $this->verificarSesion();
        $this->validarCSRF();

        $id = (int)($_POST['id'] ?? 0);

        $data = [
            'sku' => trim($_POST['sku'] ?? ''),
            'nombre' => trim($_POST['nombre'] ?? ''),
            'descripcion' => trim($_POST['descripcion'] ?? ''),
            'precio_compra' => trim($_POST['precio_compra'] ?? ''),
            'precio_venta' => trim($_POST['precio_venta'] ?? ''),
            'existencia' => trim($_POST['existencia'] ?? '')
        ];

        if ($id <= 0){
            $_SESSION['error'] = 'ID inválido.';
            header('Location: '. BASE_URL .'productos');
            exit;
        }

        if(
            $data['sku'] === '' ||
            $data['nombre'] === '' ||
            $data['descripcion'] === '' ||
            $data['precio_compra'] === '' ||
            $data['precio_venta'] === '' ||
            $data['existencia'] === '')
        {
            $_SESSION['error'] = 'Todos los campos son obligatorios.';
            header('Location: '. BASE_URL .'productos/edit/' . $id);
            exit;
        }

        if (!is_numeric($data['precio_compra']) || !is_numeric($data['precio_venta'])
        || !is_numeric($data['existencia'])) {
            $_SESSION['error'] = 'Precio de compra, precio de venta y existencia deben ser numéricos.';
            header('Location: '. BASE_URL .'productos/edit/' . $id);
            exit;
        }

        if ((float)$data['precio_compra'] < 0 || (float)$data['precio_venta'] < 0 ||
        (int)$data['existencia'] < 0 ){
            $_SESSION['error'] = 'No se permiten valores negativos.';
            header('Location: '. BASE_URL .'productos/edit/' . $id);
            exit;
        }

        // Validar que el precio de venta sea mayor o igual al de compra
        if ((float)$data['precio_venta'] < (float)$data['precio_compra']) {
            $_SESSION['error'] = 'El precio de venta no puede ser menor al precio de compra.';
            header('Location: '. BASE_URL .'productos/edit/' . $id);
            exit;
        }

        // Validar que el stock no sea negativo
        if ((int)$data['existencia'] < 0) {
            $_SESSION['error'] = 'La existencia no puede ser menor a cero.';
            header('Location: '. BASE_URL .'productos/edit/' . $id);
            exit;
        }

        // validar sku unico pasando el id para que no se bloquee a si mismo
        if ($this->productoModel->existeSku($data['sku'], $id)) {
            $_SESSION['error'] = 'El SKU ingresado ya pertenece a otro producto.';
            header('Location: '. BASE_URL .'productos/edit/' . $id);
            exit;
        }

        // consultar el producto como esta ahorita para ver si ya tenia foto
        $productoActual = $this->productoModel->obtenerPorId($id);
        $nombreImagen = $productoActual['imagen'] ?? null;
        // si subieron una foto nueva en este momento, hacemos el cambio
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
            $nombreImagen = time() . '_' . uniqid() . '.' . $ext;
            $rutaDestino = __DIR__ . '/../img/' . $nombreImagen;
            
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
                // si el producto ya tenia una foto vieja guardada, la borramos para no llenar la carpeta de basura
                if (!empty($productoActual['imagen'])) {
                    $fotoVieja = __DIR__ . '/../img/' . $productoActual['imagen'];
                    if (file_exists($fotoVieja)) {
                        unlink($fotoVieja); // unlink borra archivos en php
                    }
                }
            }
        }
        // actualizar el array con la foto nueva o la que ya tenia
        $data['imagen'] = $nombreImagen;

        if ($this->productoModel->actualizar($id, $data)){
            $this->bitacora->log($this->usuario, "Producto con ID ".$id." actualizado");
            $_SESSION['success'] = 'Producto actualizado correctamente.';
        } else {
            $this->bitacora->log($this->usuario, "FALLO al actualizar producto con ID ".$id);
            $_SESSION['error'] = 'No fue posible actualizar el producto.';
        }

        header('Location: '. BASE_URL .'productos');
        exit;

    }

    public function delete(): void{
        $this->verificarSesion();
        $this->validarCSRF();
        $id = (int)($_POST['id'] ?? 0);

        if ($id <= 0){
            $_SESSION['error'] = 'ID inválido.';
            header('Location: '. BASE_URL .'productos');
            exit;
        }

        // buscar el producto antes de borrarlo para ver si tiene foto guardada
        $producto = $this->productoModel->obtenerPorId($id);
        if ($this->productoModel->eliminar($id)){
            $this->bitacora->log($this->usuario, "Producto con ID ".$id." eliminado");
            // si se borro bien de la base de datos y tenia foto, la borramos del disco
            if ($producto && !empty($producto['imagen'])) {
                $rutaFoto = __DIR__ . '/../img/' . $producto['imagen'];
                if (file_exists($rutaFoto)) {
                    unlink($rutaFoto);
                }
            }
            $_SESSION['success'] = 'Producto eliminado correctamente.';
        } else {
            $this->bitacora->log($this->usuario, "FALLO al intentar eliminar producto ID: " . $id);
            $_SESSION['error'] = 'No fue posible eliminar el producto.';
        }

        header('Location: '. BASE_URL .'productos');
        exit;
    }

    //validación CSRF
    private function validarCSRF(): void {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['error'] = "Error de seguridad: Intento de falsificación de petición (CSRF).";
        header('Location: ' . BASE_URL . 'productos');
        exit;
    }
}
}
?>