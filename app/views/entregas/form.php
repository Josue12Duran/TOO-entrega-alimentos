<?php $isEdit = !empty($entrega); ?>
<h2><?= $isEdit ? 'Editar Entrega' : 'Nueva Entrega' ?></h2>

<form method="post" action="index.php?controller=entregas&action=<?= $action ?>">
    <?php if($isEdit): ?>
        <input type="hidden" name="id_entrega" value="<?= htmlspecialchars($entrega['id_entrega']) ?>">
    <?php endif; ?>
    <div class="mb-3">
        <label for="id_centro" class="form-label">Centro</label>
        <select id="id_centro" name="id_centro" class="form-select">
            <?php foreach($centros as $c): ?>
                <option value="<?= $c['id_centro'] ?>" <?= $isEdit && ($entrega['id_centro'] ?? '') == $c['id_centro'] ? 'selected' : '' ?>><?= htmlspecialchars($c['nombre']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="id_alimento" class="form-label">Tipo de Alimento</label>
        <select id="id_alimento" name="id_alimento" class="form-select">
            <?php foreach($tipos as $t): ?>
                <option value="<?= $t['id_alimento'] ?>" <?= $isEdit && ($entrega['id_alimento'] ?? '') == $t['id_alimento'] ? 'selected' : '' ?>><?= htmlspecialchars($t['nombre']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="id_responsable" class="form-label">Responsable</label>
        <select id="id_responsable" name="id_responsable" class="form-select">
            <option value="">-- Ninguno --</option>
            <?php foreach($responsables as $r): ?>
                <option value="<?= $r['id_responsable'] ?>" <?= $isEdit && ($entrega['id_responsable'] ?? '') == $r['id_responsable'] ? 'selected' : '' ?>><?= htmlspecialchars($r['nombre']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="fecha_entrega" class="form-label">Fecha entrega</label>
        <input id="fecha_entrega" name="fecha_entrega" type="date" class="form-control" value="<?= $isEdit ? htmlspecialchars($entrega['fecha_entrega']) : '' ?>">
    </div>
    <div class="mb-3">
        <label for="cantidad_entregada" class="form-label">Cantidad entregada</label>
        <input id="cantidad_entregada" name="cantidad_entregada" type="number" class="form-control" value="<?= $isEdit ? htmlspecialchars($entrega['cantidad_entregada']) : '' ?>">
    </div>
    <div class="mb-3">
        <label for="observaciones" class="form-label">Observaciones</label>
        <input id="observaciones" name="observaciones" class="form-control" value="<?= $isEdit ? htmlspecialchars($entrega['observaciones']) : '' ?>">
    </div>
    <button class="btn btn-primary">Guardar</button>
    <a class="btn btn-secondary" href="index.php?controller=entregas&action=index">Cancelar</a>
</form>
