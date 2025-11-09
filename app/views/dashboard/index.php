<div class="dashboard-center">
  <div class="py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Panel de control</h2>
    <?php if(!empty($user)): ?>
      <div>Bienvenido, <strong><?= htmlspecialchars($user['rol']) ?></strong></div>
    <?php endif; ?>
  </div>

  <div class="row">
    <?php if (!empty($user) && $user['rol'] === 'admin'): ?>
    <div class="col-12 col-md-6 col-lg-4 mb-3">
      <a class="card h-100 text-decoration-none text-dark" href="index.php?controller=tipos&action=index">
        <div class="card-body">
          <h5 class="card-title">Alimentos</h5>
          <p class="card-text">Gestiona los alimentos.</p>
        </div>
      </a>
    </div>
    <?php endif; ?>
    <?php if (!empty($user) && $user['rol'] === 'admin'): ?>
    <div class="col-12 col-md-6 col-lg-4 mb-3">
      <a class="card h-100 text-decoration-none text-dark" href="index.php?controller=centros&action=index">
        <div class="card-body">
          <h5 class="card-title">Centros</h5>
          <p class="card-text">Gestiona los centros educativos.</p>
        </div>
      </a>
    </div>
    <?php endif; ?>
    <?php if (!empty($user) && $user['rol'] === 'admin'): ?>
    <div class="col-12 col-md-6 col-lg-4 mb-3">
      <a class="card h-100 text-decoration-none text-dark" href="index.php?controller=responsables&action=index">
        <div class="card-body">
          <h5 class="card-title">Responsables</h5>
          <p class="card-text">Gestiona responsables.</p>
        </div>
      </a>
    </div>
    <?php endif; ?>

    <?php if (!empty($user) && $user['rol'] === 'admin'): ?>
    <div class="col-12 col-md-6 col-lg-4 mb-3">
      <a class="card h-100 text-decoration-none text-dark" href="index.php?controller=usuarios&action=index">
        <div class="card-body">
          <h5 class="card-title">Usuarios</h5>
          <p class="card-text">Gestiona usuarios y roles.</p>
        </div>
      </a>
    </div>
    <?php endif; ?>

  <?php if (!empty($user) && in_array($user['rol'], ['admin','supervisor'])): ?>
    <div class="col-12 col-md-6 col-lg-4 mb-3">
      <a class="card h-100 text-decoration-none text-dark" href="index.php?controller=cronogramas&action=index">
        <div class="card-body">
          <h5 class="card-title">Cronogramas</h5>
          <p class="card-text">Gestiona cronogramas de entrega.</p>
        </div>
      </a>
    </div>
    <?php endif; ?>

  <?php if (!empty($user) && in_array($user['rol'], ['admin','supervisor'])): ?>
    <div class="col-12 col-md-6 col-lg-4 mb-3">
      <a class="card h-100 text-decoration-none text-dark" href="index.php?controller=entregas&action=index">
        <div class="card-body">
          <h5 class="card-title">Entregas</h5>
          <p class="card-text">Registra y consulta entregas.</p>
        </div>
      </a>
    </div>
    <?php endif; ?>

    <?php if (!empty($user) && $user['rol'] === 'admin'): ?>
    <div class="col-12 col-md-6 col-lg-4 mb-3">
      <a class="card h-100 text-decoration-none text-dark" href="index.php?controller=reportes&action=index">
        <div class="card-body">
          <h5 class="card-title">Reportes</h5>
          <p class="card-text">Genera y descarga reportes (PDF).</p>
        </div>
      </a>
    </div>
    <?php endif; ?>

  </div>
</div>
