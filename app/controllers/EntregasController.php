<?php
require_once __DIR__ . '/../models/Entrega.php';
require_once __DIR__ . '/../models/CentroEducativo.php';
require_once __DIR__ . '/../models/TipoAlimento.php';
require_once __DIR__ . '/../models/Responsable.php';

class EntregasController extends Controller
{
    public function index()
    {
        $this->requireLogin();
        $m = new Entrega();
        $entregas = $m->all();
        $c = new CentroEducativo();
        $centros = $c->all();
        $mapC = [];
        foreach ($centros as $x) $mapC[$x['id_centro']] = $x['nombre'];
        $t = new TipoAlimento();
        $tipos = $t->all();
        $mapT = [];
        foreach ($tipos as $x) $mapT[$x['id_alimento']] = $x['nombre'];
        $r = new Responsable();
        $responsables = $r->all();
        $mapR = [];
        foreach ($responsables as $x) $mapR[$x['id_responsable']] = $x['nombre'];

        $this->view('entregas/index', ['entregas' => $entregas, 'centros_map' => $mapC, 'tipos_map' => $mapT, 'responsables_map' => $mapR]);
    }

    public function create()
    {
        $this->requireLogin();
    $this->requireRole(['admin','supervisor']);
        $c = new CentroEducativo(); $centros = $c->all();
        $t = new TipoAlimento(); $tipos = $t->all();
        $r = new Responsable(); $responsables = $r->all();
        $this->view('entregas/form', ['action' => 'store', 'entrega' => null, 'centros' => $centros, 'tipos' => $tipos, 'responsables' => $responsables]);
    }

    public function store()
    {
        $this->requireLogin();
    $this->requireRole(['admin','supervisor']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $m = new Entrega();
            $m->create([
                'id_centro' => $_POST['id_centro'] ?? null,
                'id_alimento' => $_POST['id_alimento'] ?? null,
                'id_responsable' => $_POST['id_responsable'] ?? null,
                'fecha_entrega' => $_POST['fecha_entrega'] ?? null,
                'cantidad_entregada' => $_POST['cantidad_entregada'] ?? 0,
                'observaciones' => trim($_POST['observaciones'] ?? '')
            ]);
        }
        $this->redirect('index.php?controller=entregas&action=index');
    }

    public function edit()
    {
        $this->requireLogin();
    $this->requireRole(['admin','supervisor']);
        $id = $_GET['id'] ?? null;
        $m = new Entrega();
        $entrega = $m->find($id, 'id_entrega');
        $c = new CentroEducativo(); $centros = $c->all();
        $t = new TipoAlimento(); $tipos = $t->all();
        $r = new Responsable(); $responsables = $r->all();
        $this->view('entregas/form', ['action' => 'update', 'entrega' => $entrega, 'centros' => $centros, 'tipos' => $tipos, 'responsables' => $responsables]);
    }

    public function update()
    {
        $this->requireLogin();
    $this->requireRole(['admin','supervisor']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_entrega'];
            $m = new Entrega();
            $m->updateRecord($id, [
                'id_centro' => $_POST['id_centro'] ?? null,
                'id_alimento' => $_POST['id_alimento'] ?? null,
                'id_responsable' => $_POST['id_responsable'] ?? null,
                'fecha_entrega' => $_POST['fecha_entrega'] ?? null,
                'cantidad_entregada' => $_POST['cantidad_entregada'] ?? 0,
                'observaciones' => trim($_POST['observaciones'] ?? '')
            ]);
        }
        $this->redirect('index.php?controller=entregas&action=index');
    }

    public function delete()
    {
        $this->requireLogin();
    $this->requireRole(['admin','supervisor']);
        $id = $_GET['id'] ?? null;
        $m = new Entrega();
        $m->delete($id, 'id_entrega');
        $this->redirect('index.php?controller=entregas&action=index');
    }
}
