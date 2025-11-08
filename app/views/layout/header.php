<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TOO - Entrega de Alimentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <?php
      $isLoginPage = (isset($_GET['controller']) && $_GET['controller'] === 'auth' && isset($_GET['action']) && $_GET['action'] === 'login');
      if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }
    ?>
    <style>
        body { padding-top: <?php echo $isLoginPage ? '0' : '70px'; ?>; }
      </style>
    </head>
  <body class="<?php echo $isLoginPage ? 'login-page' : '' ?>">
    <?php if (! $isLoginPage): ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
  <a class="navbar-brand" href="index.php?controller=dashboard&action=index">Entrega Alimentos</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample07">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
  <?php
  $role = $_SESSION['user']['rol'] ?? null;
  // Tipos: admin, supervisor
        if ($role === 'admin'): ?>
          <li class="nav-item"><a class="nav-link" href="index.php?controller=tipos&action=index">Tipos de Alimento</a></li>
        <?php endif; ?>
        <?php if ($role === 'admin'): ?>
          <li class="nav-item"><a class="nav-link" href="index.php?controller=centros&action=index">Centros</a></li>
        <?php endif; ?>
        <?php if ($role === 'admin'): ?>
          <li class="nav-item"><a class="nav-link" href="index.php?controller=responsables&action=index">Responsables</a></li>
        <?php endif; ?>
        <?php if ($role === 'admin'): ?>
          <li class="nav-item"><a class="nav-link" href="index.php?controller=usuarios&action=index">Usuarios</a></li>
        <?php endif; ?>
  <?php if (in_array($role, ['admin','supervisor'])): ?>
          <li class="nav-item"><a class="nav-link" href="index.php?controller=cronogramas&action=index">Cronogramas</a></li>
        <?php endif; ?>
  <?php if (in_array($role, ['admin','supervisor'])): ?>
          <li class="nav-item"><a class="nav-link" href="index.php?controller=entregas&action=index">Entregas</a></li>
        <?php endif; ?>
        <?php if ($role === 'admin'): ?>
          <li class="nav-item"><a class="nav-link" href="index.php?controller=reportes&action=index">Reportes</a></li>
        <?php endif; ?>
      </ul>
      <ul class="navbar-nav ms-auto">
        <?php
        if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }
        if (!empty($_SESSION['user'])): ?>
          <li class="nav-item"><a class="nav-link" href="index.php?controller=auth&action=logout">Cerrar sesión</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="index.php?controller=auth&action=login">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<?php endif; ?>

<main class="<?php echo $isLoginPage ? 'container-fluid p-0' : 'container'; ?>">
