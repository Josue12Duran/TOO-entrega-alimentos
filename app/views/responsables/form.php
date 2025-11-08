<?php $isEdit = !empty($responsable); ?>
<h2><?= $isEdit ? 'Editar Responsable' : 'Nuevo Responsable' ?></h2>

<form method="post" action="index.php?controller=responsables&action=<?= $action ?>">
    <?php if($isEdit): ?>
        <input type="hidden" name="id_responsable" value="<?= htmlspecialchars($responsable['id_responsable']) ?>">
    <?php endif; ?>
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input id="nombre" name="nombre" class="form-control" required value="<?= $isEdit ? htmlspecialchars($responsable['nombre']) : '' ?>">
    </div>
    <div class="mb-3">
        <label for="cargo" class="form-label">Cargo</label>
        <input id="cargo" name="cargo" class="form-control" value="<?= $isEdit ? htmlspecialchars($responsable['cargo']) : '' ?>">
    </div>
    <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono</label>
        <input id="telefono" name="telefono" class="form-control" value="<?= $isEdit ? htmlspecialchars($responsable['telefono']) : '' ?>">
    </div>
    <button class="btn btn-primary">Guardar</button>
    <a class="btn btn-secondary" href="index.php?controller=responsables&action=index">Cancelar</a>
</form>
