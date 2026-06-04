<?php
namespace Controllers;

use Models\ProductoModel;

class PublicController{
    public function catalogo(): void{
        $termino = trim($_GET['buscar'] ?? '');
        // sacar la pagina actual del get
        $paginaActual = (int)($_GET['p'] ?? 1);
        if ($paginaActual < 1) {
            $paginaActual = 1;
        }

        $productosPorPagina = 6; // cantidad de filas por pagina
        $offset = ($paginaActual - 1) * $productosPorPagina;
        $productoModel = new ProductoModel();
        $totalProductos = $productoModel->contarPublico($termino);
        $totalPaginas = (int)ceil($totalProductos / $productosPorPagina);
        // si la pagina es mas alta que el total, nos quedamos en la ultima
        if ($totalPaginas > 0 && $paginaActual > $totalPaginas) {
            $paginaActual = $totalPaginas;
            $offset = ($paginaActual - 1) * $productosPorPagina; // actualizar el offset real
        }

        $productos = $productoModel->obtenerPaginados($productosPorPagina, $offset, $termino);

        require_once __DIR__ . '/../views/public/catalogo.php';
    }
}
?>