<?php
require_once __DIR__ . '/../models/Responsable.php';

class ResponsablesController extends Controller
{
    public function index()
    {
        $this->requireLogin();
        $m = new Responsable();
        $items = $m->all();
        $this->view('responsables/index', ['responsables' => $items]);
    }

    public function create()
    {
        $this->requireLogin();
    $this->requireRole(['admin','supervisor']);
        $this->view('responsables/form', ['action' => 'store', 'responsable' => null]);
    }

    public function store()
    {
        $this->requireLogin();
    $this->requireRole(['admin','supervisor']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $m = new Responsable();
            $m->create([
                'nombre' => trim($_POST['nombre'] ?? ''),
                'cargo' => trim($_POST['cargo'] ?? ''),
                'telefono' => trim($_POST['telefono'] ?? '')
            ]);
        }
        $this->redirect('index.php?controller=responsables&action=index');
    }

    public function edit()
    {
        $this->requireLogin();
    $this->requireRole(['admin','supervisor']);
        $id = $_GET['id'] ?? null;
        $m = new Responsable();
        $item = $m->find($id, 'id_responsable');
        $this->view('responsables/form', ['action' => 'update', 'responsable' => $item]);
    }

    public function update()
    {
        $this->requireLogin();
    $this->requireRole(['admin','supervisor']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_responsable'];
            $m = new Responsable();
            $m->updateRecord($id, [
                'nombre' => trim($_POST['nombre'] ?? ''),
                'cargo' => trim($_POST['cargo'] ?? ''),
                'telefono' => trim($_POST['telefono'] ?? '')
            ]);
        }
        $this->redirect('index.php?controller=responsables&action=index');
    }

    public function delete()
    {
        $this->requireLogin();
    $this->requireRole(['admin','supervisor']);
        $id = $_GET['id'] ?? null;
        $m = new Responsable();
        $m->delete($id, 'id_responsable');
        $this->redirect('index.php?controller=responsables&action=index');
    }
}
