<?php

/**
 * Sistema de Autocarga de Clases (Autoloader)
 *
 * Registra una función anónima encargada de mapear e incluir automáticamente
 * los archivos de clases del proyecto según su espacio de nombres (Namespace).
 */
spl_autoload_register(function ($class) {
    /**
     * Mapea el Namespace de la clase y realiza la inclusión del archivo de forma dinámica.
     *
     * Transforma los separadores de barra invertida en barras diagonales convencionales,
     * convierte el componente raíz a minúsculas para respetar la estructura de carpetas,
     * verifica la existencia física del archivo en el servidor y lo incluye de forma única.
     *
     * @param string $class Nombre calificado de la clase que el sistema intenta instanciar.
     * @return void
     */
    $baseDir = __DIR__ . '/../';
    $class = str_replace('\\', '/', $class);
    $parts = explode('/', $class);
    if (!empty($parts)) {
        $parts[0] = strtolower($parts[0]);
    }
    $file = $baseDir . implode('/', $parts) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});
?>