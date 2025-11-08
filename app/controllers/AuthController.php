<?php
require_once __DIR__ . '/../models/Usuario.php';

class AuthController extends Controller
{
    public function login()
    {
        $this->view('auth/login', []);
    }

    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = trim($_POST['usuario'] ?? '');
            $password = $_POST['password'] ?? '';
            $u = new Usuario();
            $user = $u->findByUsername($usuario);
            if ($user && password_verify($password, $user['password'])) {
                if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'usuario' => $user['usuario'],
                    'rol' => $user['rol']
                ];
                header('Location: index.php?controller=dashboard&action=index');
                exit;
            } else {
                $this->view('auth/login', ['error' => 'Credenciales inválidas']);
                return;
            }
        }
        $this->redirect('index.php?controller=auth&action=login');
    }

    public function logout()
    {
    if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }
    session_destroy();
        header('Location: index.php?controller=auth&action=login');
        exit;
    }
}
