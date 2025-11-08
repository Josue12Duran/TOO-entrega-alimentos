<div class="row align-items-center min-vh-100">
  <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
    <div class="px-4 w-100">
      <h1 class="login-title fw-bold">Sistema Nacional de Entrega de Alimentos</h1>
    </div>
  </div>

  <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
    <div class="card shadow" style="width:100%; max-width:420px;">
      <div class="card-body">
        <h4 class="card-title mb-3 text-center">Login</h4>
        <?php if(!empty($error)): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post" action="index.php?controller=auth&action=authenticate">
          <div class="mb-3">
            <label for="usuario" class="form-label">Usuario</label>
            <input id="usuario" name="usuario" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" name="password" type="password" class="form-control" required>
          </div>
          <div class="d-flex justify-content-center">
            <button class="btn btn-primary px-4">Iniciar sesión</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
