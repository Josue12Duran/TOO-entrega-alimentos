<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Centros Educativos</h2>
    <a class="btn btn-primary" href="index.php?controller=centros&action=create">Nuevo Centro</a>
</div>

<div class="table-responsive">
<table class="table table-striped">
    <thead><tr><th>ID</th><th>Nombre</th><th>Departamento</th><th>Estudiantes</th><th>Dirección</th><th>Acciones</th></tr></thead>
    <tbody>
    <?php foreach($centros as $c): ?>
        <tr>
            <td><?= htmlspecialchars($c['id_centro']) ?></td>
            <td><?= htmlspecialchars($c['nombre']) ?></td>
            <td><?= htmlspecialchars($departamentos_map[$c['id_departamento']] ?? $c['id_departamento']) ?></td>
            <td><?= htmlspecialchars($c['cantidad_estudiantes']) ?></td>
            <td><?= htmlspecialchars($c['direccion']) ?></td>
            <td>
                <a class="btn btn-sm btn-secondary" href="index.php?controller=centros&action=edit&id=<?= $c['id_centro'] ?>">Editar</a>
                <a class="btn btn-sm btn-danger btn-delete" href="index.php?controller=centros&action=delete&id=<?= $c['id_centro'] ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
