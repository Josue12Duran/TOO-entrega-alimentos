<?php
require_once __DIR__ . '/../models/Usuario.php';

class UsuariosController extends Controller
{
    public function index()
    {
        $this->requireLogin();
        $m = new Usuario();
        $items = $m->all();
        $this->view('usuarios/index', ['usuarios' => $items]);
    }

    public function create()
    {
        $this->requireLogin();
        $this->requireRole(['admin']);
        $this->view('usuarios/form', ['action' => 'store', 'usuario' => null]);
    }

    public function store()
    {
        $this->requireLogin();
        $this->requireRole(['admin']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $m = new Usuario();
            $allowedRoles = ['admin','supervisor'];
            $rol = $_POST['rol'] ?? 'supervisor';
            if (!in_array($rol, $allowedRoles)) { $rol = 'supervisor'; }

            $m->create([
                'usuario' => trim($_POST['usuario'] ?? ''),
                'password' => $_POST['password'] ?? '',
                'nombre_completo' => trim($_POST['nombre_completo'] ?? ''),
                'rol' => $rol
            ]);
        }
        $this->redirect('index.php?controller=usuarios&action=index');
    }

    public function edit()
    {
        $this->requireLogin();
        $this->requireRole(['admin']);
        $id = $_GET['id'] ?? null;
        $m = new Usuario();
        $item = $m->find($id, 'id');
        $this->view('usuarios/form', ['action' => 'update', 'usuario' => $item]);
    }

    public function update()
    {
        $this->requireLogin();
        $this->requireRole(['admin']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $m = new Usuario();
            $allowedRoles = ['admin','supervisor'];
            $rol = $_POST['rol'] ?? 'supervisor';
            if (!in_array($rol, $allowedRoles)) { $rol = 'supervisor'; }

            $m->updateRecord($id, [
                'usuario' => trim($_POST['usuario'] ?? ''),
                'password' => $_POST['password'] ?? '',
                'nombre_completo' => trim($_POST['nombre_completo'] ?? ''),
                'rol' => $rol
            ]);
        }
        $this->redirect('index.php?controller=usuarios&action=index');
    }

    public function delete()
    {
        $this->requireLogin();
        $this->requireRole(['admin']);
        $id = $_GET['id'] ?? null;
        $m = new Usuario();
        $m->delete($id, 'id');
        $this->redirect('index.php?controller=usuarios&action=index');
    }
}
