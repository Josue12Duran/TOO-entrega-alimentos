<?php
require_once __DIR__ . '/../models/CentroEducativo.php';
require_once __DIR__ . '/../models/Departamento.php';

class CentrosController extends Controller
{
    public function index()
    {
        $this->requireLogin();
        $m = new CentroEducativo();
        $centros = $m->all();
        $d = new Departamento();
        $departamentos = $d->all();
        $map = [];
        foreach ($departamentos as $dep) { $map[$dep['id_departamento']] = $dep['nombre']; }
        $this->view('centros/index', ['centros' => $centros, 'departamentos_map' => $map]);
    }

    public function create()
    {
        $this->requireLogin();
    $this->requireRole(['admin','supervisor']);
        $d = new Departamento();
        $departamentos = $d->all();
        $this->view('centros/form', ['action' => 'store', 'centro' => null, 'departamentos' => $departamentos]);
    }

    public function store()
    {
        $this->requireLogin();
    $this->requireRole(['admin','supervisor']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $m = new CentroEducativo();
            $m->create([
                'nombre' => trim($_POST['nombre'] ?? ''),
                'id_departamento' => $_POST['id_departamento'] ?? null,
                'cantidad_estudiantes' => $_POST['cantidad_estudiantes'] ?? 0,
                'direccion' => trim($_POST['direccion'] ?? '')
            ]);
        }
        $this->redirect('index.php?controller=centros&action=index');
    }

    public function edit()
    {
        $this->requireLogin();
    $this->requireRole(['admin','supervisor']);
        $id = $_GET['id'] ?? null;
        $m = new CentroEducativo();
        $centro = $m->find($id, 'id_centro');
        $d = new Departamento();
        $departamentos = $d->all();
        $this->view('centros/form', ['action' => 'update', 'centro' => $centro, 'departamentos' => $departamentos]);
    }

    public function update()
    {
        $this->requireLogin();
    $this->requireRole(['admin','supervisor']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_centro'];
            $m = new CentroEducativo();
            $m->updateRecord($id, [
                'nombre' => trim($_POST['nombre'] ?? ''),
                'id_departamento' => $_POST['id_departamento'] ?? null,
                'cantidad_estudiantes' => $_POST['cantidad_estudiantes'] ?? 0,
                'direccion' => trim($_POST['direccion'] ?? '')
            ]);
        }
        $this->redirect('index.php?controller=centros&action=index');
    }

    public function delete()
    {
        $this->requireLogin();
    $this->requireRole(['admin','supervisor']);
        $id = $_GET['id'] ?? null;
        $m = new CentroEducativo();
        $m->delete($id, 'id_centro');
        $this->redirect('index.php?controller=centros&action=index');
    }
}
