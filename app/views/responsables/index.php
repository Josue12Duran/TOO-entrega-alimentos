<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Responsables</h2>
    <a class="btn btn-primary" href="index.php?controller=responsables&action=create">Nuevo Responsable</a>
</div>

<div class="table-responsive">
<table class="table table-striped">
    <thead><tr><th>ID</th><th>Nombre</th><th>Cargo</th><th>Teléfono</th><th>Acciones</th></tr></thead>
    <tbody>
    <?php foreach($responsables as $r): ?>
        <tr>
            <td><?= htmlspecialchars($r['id_responsable']) ?></td>
            <td><?= htmlspecialchars($r['nombre']) ?></td>
            <td><?= htmlspecialchars($r['cargo']) ?></td>
            <td><?= htmlspecialchars($r['telefono']) ?></td>
            <td>
                <a class="btn btn-sm btn-secondary" href="index.php?controller=responsables&action=edit&id=<?= $r['id_responsable'] ?>">Editar</a>
                <a class="btn btn-sm btn-danger btn-delete" href="index.php?controller=responsables&action=delete&id=<?= $r['id_responsable'] ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
