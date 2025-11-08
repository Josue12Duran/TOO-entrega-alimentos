<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Entregas</h2>
    <?php if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    } ?>
    <?php if (!empty($_SESSION['user']) && in_array($_SESSION['user']['rol'], ['admin', 'supervisor'])): ?>
        <a class="btn btn-primary" href="index.php?controller=entregas&action=create">Nueva Entrega</a>
    <?php endif; ?>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Centro</th>
                <th>Alimento</th>
                <th>Responsable</th>
                <th>Fecha</th>
                <th>Cantidad</th>
                <th>Observaciones</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($entregas as $e): ?>
                <tr>
                    <td><?= htmlspecialchars($e['id_entrega'] ?? $e['id']) ?></td>
                    <td><?= htmlspecialchars($centros_map[$e['id_centro']] ?? ($e['id_centro'] ?? '')) ?></td>
                    <td><?= htmlspecialchars($tipos_map[$e['id_alimento']] ?? ($e['id_alimento'] ?? '')) ?></td>
                    <td><?= htmlspecialchars($responsables_map[$e['id_responsable']] ?? ($e['id_responsable'] ?? '')) ?></td>
                    <td><?= htmlspecialchars($e['fecha_entrega'] ?? '') ?></td>
                    <td><?= htmlspecialchars($e['cantidad_entregada'] ?? '') ?></td>
                    <td><?= htmlspecialchars($e['observaciones'] ?? '') ?></td>
                    <td>
                        <?php if (!empty($_SESSION['user']) && in_array($_SESSION['user']['rol'], ['admin', 'supervisor'])): ?>
                            <a class="btn btn-sm btn-secondary" href="index.php?controller=entregas&action=edit&id=<?= $e['id_entrega'] ?? $e['id'] ?>">Editar</a>
                            <a class="btn btn-sm btn-danger btn-delete" href="index.php?controller=entregas&action=delete&id=<?= $e['id_entrega'] ?? $e['id'] ?>">Eliminar</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>