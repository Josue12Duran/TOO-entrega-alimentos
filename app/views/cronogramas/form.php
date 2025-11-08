<?php $isEdit = !empty($cronograma); ?>
<h2><?= $isEdit ? 'Editar Cronograma' : 'Nuevo Cronograma' ?></h2>

<?php if(!empty($error)): ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="post" action="index.php?controller=cronogramas&action=<?= $action ?>">
    <?php if($isEdit): ?>
        <input type="hidden" name="id_cronograma" value="<?= htmlspecialchars($cronograma['id_cronograma']) ?>">
    <?php endif; ?>
    <div class="mb-3">
        <label for="id_centro" class="form-label">Centro</label>
        <select id="id_centro" name="id_centro" class="form-select">
            <?php foreach($centros as $c): ?>
                <option value="<?= $c['id_centro'] ?>" <?= $isEdit && ($cronograma['id_centro'] ?? '') == $c['id_centro'] ? 'selected' : '' ?>><?= htmlspecialchars($c['nombre']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="id_alimento" class="form-label">Tipo de Alimento</label>
        <select id="id_alimento" name="id_alimento" class="form-select">
            <?php foreach($tipos as $t): ?>
                <option value="<?= $t['id_alimento'] ?>" <?= $isEdit && ($cronograma['id_alimento'] ?? '') == $t['id_alimento'] ? 'selected' : '' ?>><?= htmlspecialchars($t['nombre']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="fecha_programada" class="form-label">Fecha programada</label>
        <?php $minDate = date('Y-m-d', strtotime('+1 day')); ?>
        <input id="fecha_programada" name="fecha_programada" type="date" class="form-control" min="<?= $minDate ?>" value="<?= $isEdit ? htmlspecialchars($cronograma['fecha_programada']) : ($_POST['fecha_programada'] ?? '') ?>">
        <div class="form-text">La fecha debe ser mayor a hoy (mínimo <?= $minDate ?>).</div>
    </div>
    <div class="mb-3">
        <label for="cantidad_planificada" class="form-label">Cantidad planificada</label>
        <input id="cantidad_planificada" name="cantidad_planificada" type="number" class="form-control" value="<?= $isEdit ? htmlspecialchars($cronograma['cantidad_planificada']) : '' ?>">
    </div>
    <div class="mb-3">
        <label for="observaciones" class="form-label">Observaciones</label>
        <input id="observaciones" name="observaciones" class="form-control" value="<?= $isEdit ? htmlspecialchars($cronograma['observaciones']) : '' ?>">
    </div>
    <button class="btn btn-primary">Guardar</button>
    <a class="btn btn-secondary" href="index.php?controller=cronogramas&action=index">Cancelar</a>
</form>
