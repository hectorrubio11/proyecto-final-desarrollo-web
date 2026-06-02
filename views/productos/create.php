<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h2>Registrar producto</h2>

<form action="<?= BASE_URL ?>productos/store" method="post">
    <div class="mb-3">
        <label class="form-label">SKU</label>
        <input type="text" name="sku" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea type="text" name="descripcion" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Precio compra</label>
        <input type="number" step="0.01" name="precio_compra" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Precio venta</label>
        <input type="number" step="0.01" name="precio_venta" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Existencia</label>
        <input type="number" name="existencia" class="form-control" required>
    </div>

    <button class="btn btn-success" type="submit">Guardar</button>
    <a href="<?= BASE_URL ?>productos" class="btn btn-secondary">Cancelar</a>
</form>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
