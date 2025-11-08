<?php
class Controller
{
    protected function view($path, $data = [])
    {
        extract($data);
        require_once __DIR__ . '/../views/layout/header.php';
        require_once __DIR__ . '/../views/' . $path . '.php';
        require_once __DIR__ . '/../views/layout/footer.php';
    }

    protected function redirect($url)
    {
        header('Location: ' . $url);
        exit;
    }

    // Simple auth helpers
    protected function requireLogin()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }
        if (empty($_SESSION['user'])) {
            header('Location: ../index.php?controller=auth&action=login');
            exit;
        }
    }

    protected function requireRole(array $roles)
    {
        if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }
        if (empty($_SESSION['user']) || !in_array($_SESSION['user']['rol'], $roles)) {
            // forbidden
            header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
            echo 'Acceso denegado';
            exit;
        }
    }
}
