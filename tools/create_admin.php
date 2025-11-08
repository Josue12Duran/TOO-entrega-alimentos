<?php
require_once __DIR__ . '/../app/core/Database.php';
$pdo = Database::getConnection();

$exists = $pdo->prepare("SELECT id FROM mnt_usuarios WHERE usuario = 'admin' LIMIT 1");
$exists->execute();
if ($exists->fetch()) {
    echo 'Admin already exists.';
    exit;
}

$hash = password_hash('Admin123', PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO mnt_usuarios (usuario, password, nombre_completo, rol) VALUES ('admin', :pass, 'Administrador', 'admin')");
$stmt->execute(['pass' => $hash]);
echo 'Admin created: usuario=admin password=Admin123';
