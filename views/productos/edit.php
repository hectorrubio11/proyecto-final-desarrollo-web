<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<h2>Editar producto</h2>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<form action="<?= BASE_URL ?>productos/update" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= (int)$producto['id']; ?>">
    <div class="mb-3">
        <label class="form-label">SKU</label>
        <input type="text" name="sku" class="form-control"
        value="<?= htmlspecialchars($producto['sku']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" 
        value="<?= htmlspecialchars($producto['nombre']); ?>"required>
    </div>
    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <textarea name="descripcion" class="form-control" 
        required><?= htmlspecialchars($producto['descripcion']); ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Precio compra</label>
        <input type="number" step="0.01" name="precio_compra" class="form-control" 
        value="<?= htmlspecialchars((string)$producto['precio_compra']); ?>"required>
    </div>
    <div class="mb-3">
        <label class="form-label">Precio venta</label>
        <input type="number" step="0.01" name="precio_venta" class="form-control"
        value="<?= htmlspecialchars((string)$producto['precio_venta']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Existencia</label>
        <input type="number" name="existencia" class="form-control" 
        value="<?= (int)$producto['existencia']; ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Imagen del producto</label>
        <?php if (!empty($producto['imagen'])): ?>
            <div class="mb-2">
                <small class="text-muted d-block mb-1">Imagen actual:</small>
                <img src="<?= BASE_URL ?>img/<?= htmlspecialchars($producto['imagen']); ?>" alt="Foto" class="img-thumbnail" style="max-width: 150px; height: auto;">
            </div>
        <?php else: ?>
            <div class="mb-2">
                <span class="badge bg-secondary">Sin imagen registrada</span>
            </div>
        <?php endif; ?>
        
        <input type="file" name="imagen" class="form-control" accept="image/*">
        <small class="form-text text-muted">Selecciona un archivo solo si deseas cambiar la foto actual.</small>
    </div>
    
    <button class="btn btn-primary" type="submit">Actualizar</button>
    <a href="<?= BASE_URL ?>productos" class="btn btn-secondary">Cancelar</a>
</form>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
