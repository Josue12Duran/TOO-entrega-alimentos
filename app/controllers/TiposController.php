<?php
require_once __DIR__ . '/../models/TipoAlimento.php';
require_once __DIR__ . '/../models/Departamento.php';

class TiposController extends Controller
{
    public function index()
    {
        $this->requireLogin();
        $m = new TipoAlimento();
        $tipos = $m->all();
        $this->view('tipos/index', ['tipos' => $tipos]);
    }

    public function create()
    {
        $this->requireLogin();
    $this->requireRole(['admin','supervisor']);
        $this->view('tipos/form', ['action' => 'store', 'tipo' => null]);
    }

    public function store()
    {
        $this->requireLogin();
    $this->requireRole(['admin','supervisor']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            if ($nombre !== '') {
                $m = new TipoAlimento();
                $m->create(['nombre' => $nombre]);
            }
        }
        $this->redirect('index.php?controller=tipos&action=index');
    }

    public function edit()
    {
        $this->requireLogin();
    $this->requireRole(['admin','supervisor']);
        $id = $_GET['id'] ?? null;
        $m = new TipoAlimento();
        $tipo = $m->find($id, 'id_alimento');
        $this->view('tipos/form', ['action' => 'update', 'tipo' => $tipo]);
    }

    public function update()
    {
        $this->requireLogin();
    $this->requireRole(['admin','supervisor']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nombre = trim($_POST['nombre'] ?? '');
            if ($nombre !== '') {
                $m = new TipoAlimento();
                $m->updateRecord($id, ['nombre' => $nombre]);
            }
        }
        $this->redirect('index.php?controller=tipos&action=index');
    }

    public function delete()
    {
        $this->requireLogin();
    $this->requireRole(['admin','supervisor']);
        $id = $_GET['id'] ?? null;
        $m = new TipoAlimento();
        $m->delete($id, 'id_alimento');
        $this->redirect('index.php?controller=tipos&action=index');
    }
}
