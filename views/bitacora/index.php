<?php 
// Cargamos las piezas del layout directamente aquí
require_once 'views/layouts/header.php'; 
?>

<div class="container mt-4 mb-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Bitácora de Actividades</h2>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-2">
            <div class="table-responsive">
                <table class="table table-hover table-sm table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Acción</th>
                            <th>Fecha/Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($logs) && !empty($logs)): ?>
                            <?php foreach ($logs as $log): ?>
                                <tr>
                                    <td>#<?= $log['id'] ?></td>
                                    <td><?= htmlspecialchars($log['usuario']) ?></td>
                                    <td><?= htmlspecialchars($log['accion']) ?></td>
                                    <td><?= $log['fecha'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    No hay registros para mostrar.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>   
        </div>
    </div>
    <div class="text-center mb-4">
        <a href="<?= BASE_URL ?>productos" class="btn btn-secondary">Volver al catálogo</a>
    </div>    
</div>

<?php 
require_once 'views/layouts/footer.php'; 
?>
