<?php $isEdit = !empty($usuario); ?>
<h2><?= $isEdit ? 'Editar Usuario' : 'Nuevo Usuario' ?></h2>

<form method="post" action="index.php?controller=usuarios&action=<?= $action ?>">
    <?php if($isEdit): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">
    <?php endif; ?>
    <div class="mb-3">
        <label for="usuario" class="form-label">Usuario</label>
        <input id="usuario" name="usuario" class="form-control" required value="<?= $isEdit ? htmlspecialchars($usuario['usuario']) : '' ?>">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input id="password" name="password" type="password" class="form-control" <?= $isEdit ? '' : 'required' ?> >
    </div>
    <div class="mb-3">
        <label for="nombre_completo" class="form-label">Nombre completo</label>
        <input id="nombre_completo" name="nombre_completo" class="form-control" value="<?= $isEdit ? htmlspecialchars($usuario['nombre_completo']) : '' ?>">
    </div>
    <div class="mb-3">
        <label for="rol" class="form-label">Rol</label>
        <select id="rol" name="rol" class="form-select">
            <?php $roles = ['admin','supervisor']; foreach($roles as $r): ?>
                <option value="<?= $r ?>" <?= $isEdit && $usuario['rol'] == $r ? 'selected' : '' ?>><?= ucfirst($r) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button class="btn btn-primary">Guardar</button>
    <a class="btn btn-secondary" href="index.php?controller=usuarios&action=index">Cancelar</a>
</form>
