<?php
require_once __DIR__ . '/../models/Cronograma.php';
require_once __DIR__ . '/../models/CentroEducativo.php';
require_once __DIR__ . '/../models/TipoAlimento.php';

class CronogramasController extends Controller
{
    public function index()
    {
        $this->requireLogin();
        $m = new Cronograma();
        $items = $m->all();
        $c = new CentroEducativo();
        $centros = $c->all();
        $mapC = [];
        foreach ($centros as $x) { $mapC[$x['id_centro']] = $x['nombre']; }
        $t = new TipoAlimento();
        $tipos = $t->all();
        $mapT = [];
        foreach ($tipos as $x) { $mapT[$x['id_alimento']] = $x['nombre']; }
        $this->view('cronogramas/index', ['cronogramas' => $items, 'centros_map' => $mapC, 'tipos_map' => $mapT]);
    }

    public function create()
    {
        $this->requireLogin();
        $this->requireRole(['admin']);
        $c = new CentroEducativo();
        $centros = $c->all();
        $t = new TipoAlimento();
        $tipos = $t->all();
        $this->view('cronogramas/form', ['action' => 'store', 'cronograma' => null, 'centros' => $centros, 'tipos' => $tipos]);
    }

    public function store()
    {
        $this->requireLogin();
        $this->requireRole(['admin']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fecha = $_POST['fecha_programada'] ?? null;
            $today = date('Y-m-d');
            if (empty($fecha) || $fecha <= $today) {
                $c = new CentroEducativo();
                $centros = $c->all();
                $t = new TipoAlimento();
                $tipos = $t->all();
                $cronograma = [
                    'id_centro' => $_POST['id_centro'] ?? null,
                    'id_alimento' => $_POST['id_alimento'] ?? null,
                    'fecha_programada' => $_POST['fecha_programada'] ?? null,
                    'cantidad_planificada' => $_POST['cantidad_planificada'] ?? 0,
                    'observaciones' => trim($_POST['observaciones'] ?? '')
                ];
                $this->view('cronogramas/form', ['action' => 'store', 'cronograma' => $cronograma, 'centros' => $centros, 'tipos' => $tipos, 'error' => 'La fecha programada debe ser mayor a hoy.']);
                return;
            }

            $m = new Cronograma();
            $m->create([
                'id_centro' => $_POST['id_centro'] ?? null,
                'id_alimento' => $_POST['id_alimento'] ?? null,
                'fecha_programada' => $fecha,
                'cantidad_planificada' => $_POST['cantidad_planificada'] ?? 0,
                'observaciones' => trim($_POST['observaciones'] ?? '')
            ]);
        }
        $this->redirect('index.php?controller=cronogramas&action=index');
    }

    public function edit()
    {
        $this->requireLogin();
        $this->requireRole(['admin']);
        $id = $_GET['id'] ?? null;
        $m = new Cronograma();
        $item = $m->find($id, 'id_cronograma');
        $c = new CentroEducativo();
        $centros = $c->all();
        $t = new TipoAlimento();
        $tipos = $t->all();
        $this->view('cronogramas/form', ['action' => 'update', 'cronograma' => $item, 'centros' => $centros, 'tipos' => $tipos]);
    }

    public function update()
    {
        $this->requireLogin();
        $this->requireRole(['admin']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_cronograma'];
            $fecha = $_POST['fecha_programada'] ?? null;
            $today = date('Y-m-d');
            if (empty($fecha) || $fecha <= $today) {
                $c = new CentroEducativo();
                $centros = $c->all();
                $t = new TipoAlimento();
                $tipos = $t->all();
                $cronograma = [
                    'id_cronograma' => $id,
                    'id_centro' => $_POST['id_centro'] ?? null,
                    'id_alimento' => $_POST['id_alimento'] ?? null,
                    'fecha_programada' => $_POST['fecha_programada'] ?? null,
                    'cantidad_planificada' => $_POST['cantidad_planificada'] ?? 0,
                    'observaciones' => trim($_POST['observaciones'] ?? '')
                ];
                $this->view('cronogramas/form', ['action' => 'update', 'cronograma' => $cronograma, 'centros' => $centros, 'tipos' => $tipos, 'error' => 'La fecha programada debe ser mayor a hoy.']);
                return;
            }

            $m = new Cronograma();
            $m->updateRecord($id, [
                'id_centro' => $_POST['id_centro'] ?? null,
                'id_alimento' => $_POST['id_alimento'] ?? null,
                'fecha_programada' => $fecha,
                'cantidad_planificada' => $_POST['cantidad_planificada'] ?? 0,
                'observaciones' => trim($_POST['observaciones'] ?? '')
            ]);
        }
        $this->redirect('index.php?controller=cronogramas&action=index');
    }

    public function delete()
    {
        $this->requireLogin();
        $this->requireRole(['admin']);
        $id = $_GET['id'] ?? null;
        $m = new Cronograma();
        $m->delete($id, 'id_cronograma');
        $this->redirect('index.php?controller=cronogramas&action=index');
    }
}
