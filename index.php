<?php
if (isset($_GET['controller']) || isset($_GET['action']) || $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/public/index.php';
    exit;
}
header('Location: index.php?controller=auth&action=login');
exit;

