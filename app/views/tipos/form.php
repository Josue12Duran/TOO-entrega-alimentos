<?php
$isEdit = !empty($tipo);
?>
<h2><?= $isEdit ? 'Editar Alimento' : 'Nuevo Alimento' ?></h2>

<form method="post" action="index.php?controller=tipos&action=<?= $action ?>">
    <?php if($isEdit): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($tipo['id_alimento']) ?>">
    <?php endif; ?>
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input id="nombre" name="nombre" class="form-control" required value="<?= $isEdit ? htmlspecialchars($tipo['nombre']) : '' ?>">
    </div>
    <button class="btn btn-primary">Guardar</button>
    <a class="btn btn-secondary" href="index.php?controller=tipos&action=index">Cancelar</a>
</form>
