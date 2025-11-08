<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Tipos de Alimento</h2>
    <a class="btn btn-primary" href="index.php?controller=tipos&action=create">Nuevo Tipo</a>
</div>

<div class="table-responsive">
<table class="table table-striped">
    <thead><tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr></thead>
    <tbody>
    <?php foreach($tipos as $t): ?>
        <tr>
            <td><?= htmlspecialchars($t['id_alimento']) ?></td>
            <td><?= htmlspecialchars($t['nombre']) ?></td>
            <td>
                <a class="btn btn-sm btn-secondary" href="index.php?controller=tipos&action=edit&id=<?= $t['id_alimento'] ?>">Editar</a>
                <a class="btn btn-sm btn-danger btn-delete" href="index.php?controller=tipos&action=delete&id=<?= $t['id_alimento'] ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    </tbody>
</table>
</div>
