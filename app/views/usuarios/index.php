<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Usuarios</h2>
    <a class="btn btn-primary" href="index.php?controller=usuarios&action=create">Nuevo Usuario</a>
</div>

<div class="table-responsive">
<table class="table table-striped">
    <thead><tr><th>ID</th><th>Usuario</th><th>Nombre</th><th>Rol</th><th>Acciones</th></tr></thead>
    <tbody>
    <?php foreach($usuarios as $u): ?>
        <tr>
            <td><?= htmlspecialchars($u['id']) ?></td>
            <td><?= htmlspecialchars($u['usuario']) ?></td>
            <td><?= htmlspecialchars($u['nombre_completo']) ?></td>
            <td><?= htmlspecialchars($u['rol']) ?></td>
            <td>
                <a class="btn btn-sm btn-secondary" href="index.php?controller=usuarios&action=edit&id=<?= $u['id'] ?>">Editar</a>
                <a class="btn btn-sm btn-danger btn-delete" href="index.php?controller=usuarios&action=delete&id=<?= $u['id'] ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
