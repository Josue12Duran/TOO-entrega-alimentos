<div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Cronogramas</h2>
        <?php if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); } ?>
    <?php if (!empty($_SESSION['user']) && in_array($_SESSION['user']['rol'], ['admin'])): ?>
            <a class="btn btn-primary" href="index.php?controller=cronogramas&action=create">Nuevo Cronograma</a>
        <?php endif; ?>
</div>

<div class="table-responsive">
<table class="table table-striped">
    <?php $showActions = (!empty($_SESSION['user']) && in_array($_SESSION['user']['rol'], ['admin'])); ?>
    <thead>
        <tr>
            <th>ID</th>
            <th>Centro</th>
            <th>Alimento</th>
            <th>Fecha Programada</th>
            <th>Cantidad</th>
            <th>Observaciones</th>
            <?php if ($showActions): ?><th>Acciones</th><?php endif; ?>
        </tr>
    </thead>
    <tbody>
    <?php foreach($cronogramas as $c): ?>
        <tr>
            <td><?= htmlspecialchars($c['id_cronograma'] ?? $c['id']) ?></td>
            <td><?= htmlspecialchars($centros_map[$c['id_centro']] ?? ($c['id_centro'] ?? '')) ?></td>
            <td><?= htmlspecialchars($tipos_map[$c['id_alimento']] ?? ($c['id_alimento'] ?? '')) ?></td>
            <td><?= htmlspecialchars($c['fecha_programada'] ?? '') ?></td>
            <td><?= htmlspecialchars($c['cantidad_planificada'] ?? '') ?></td>
            <td><?= htmlspecialchars($c['observaciones'] ?? '') ?></td>
            <?php if ($showActions): ?>
            <td>
                <a class="btn btn-sm btn-secondary" href="index.php?controller=cronogramas&action=edit&id=<?= $c['id_cronograma'] ?? $c['id'] ?>">Editar</a>
                <a class="btn btn-sm btn-danger btn-delete" href="index.php?controller=cronogramas&action=delete&id=<?= $c['id_cronograma'] ?? $c['id'] ?>">Eliminar</a>
            </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
