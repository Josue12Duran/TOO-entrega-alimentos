<?php $isEdit = !empty($centro); ?>
<h2><?= $isEdit ? 'Editar Centro' : 'Nuevo Centro' ?></h2>

<form method="post" action="index.php?controller=centros&action=<?= $action ?>">
    <?php if($isEdit): ?>
        <input type="hidden" name="id_centro" value="<?= htmlspecialchars($centro['id_centro']) ?>">
    <?php endif; ?>
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input id="nombre" name="nombre" class="form-control" required value="<?= $isEdit ? htmlspecialchars($centro['nombre']) : '' ?>">
    </div>
    <div class="mb-3">
        <label for="id_departamento" class="form-label">Departamento</label>
        <select id="id_departamento" name="id_departamento" class="form-select">
            <?php foreach($departamentos as $d): ?>
                <option value="<?= $d['id_departamento'] ?>" <?= $isEdit && $centro['id_departamento'] == $d['id_departamento'] ? 'selected' : '' ?>><?= htmlspecialchars($d['nombre']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="cantidad_estudiantes" class="form-label">Cantidad Estudiantes</label>
        <input id="cantidad_estudiantes" name="cantidad_estudiantes" type="number" class="form-control" required value="<?= $isEdit ? htmlspecialchars($centro['cantidad_estudiantes']) : '' ?>">
    </div>
    <div class="mb-3">
        <label for="direccion" class="form-label">Dirección</label>
        <input id="direccion" name="direccion" class="form-control" value="<?= $isEdit ? htmlspecialchars($centro['direccion']) : '' ?>">
    </div>
    <button class="btn btn-primary">Guardar</button>
    <a class="btn btn-secondary" href="index.php?controller=centros&action=index">Cancelar</a>
</form>
