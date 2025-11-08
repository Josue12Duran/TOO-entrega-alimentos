<?php
require_once __DIR__ . '/../core/Database.php';

class ReportesController extends Controller
{
    public function index()
    {
        $this->requireLogin();
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT id_departamento, nombre FROM ctl_departamentos ORDER BY nombre");
        $departamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->view('reportes/index', ['departamentos' => $departamentos]);
    }

    public function entregas_pdf()
    {
        $this->requireLogin();
        $pdo = Database::getConnection();

        $departamento = $_GET['departamento'] ?? null;
        $fecha_desde = $_GET['fecha_desde'] ?? null;
        $fecha_hasta = $_GET['fecha_hasta'] ?? null;

        $conditions = [];
        $params = [];
        $sql = "SELECT departamento, centro_educativo, tipo_alimento, responsable, fecha_entrega, cantidad_entregada, observaciones FROM vista_reporte_entregas";

        if ($departamento) {
            $conditions[] = 'departamento = :departamento';
            $params['departamento'] = $departamento;
        }
        if ($fecha_desde) {
            $conditions[] = 'fecha_entrega >= :fecha_desde';
            $params['fecha_desde'] = $fecha_desde;
        }
        if ($fecha_hasta) {
            $conditions[] = 'fecha_entrega <= :fecha_hasta';
            $params['fecha_hasta'] = $fecha_hasta;
        }

        if ($conditions) {
            $sql .= ' WHERE ' . implode(' AND ', $conditions);
        }
        $sql .= ' ORDER BY departamento, fecha_entrega';

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $grouped = [];
        foreach ($rows as $r) {
            $dept = $r['departamento'] ?: 'Sin departamento';
            if (!isset($grouped[$dept])) { $grouped[$dept] = []; }
            $grouped[$dept][] = $r;
        }

        if (!defined('FPDF_FONTPATH')) {
            define('FPDF_FONTPATH', __DIR__ . '/../../public/lib/fpdf182/font/');
        }
    require_once __DIR__ . '/../../public/lib/fpdf182/fpdf.php';
    $pdf = new FPDF('P','mm','letter');
        $pdf->SetAutoPageBreak(true, 15);
        $pdf->SetTitle('Reporte de Entregas por Departamento');

        foreach ($grouped as $dept => $items) {
            $pdf->AddPage();
            $pdf->SetFont('Arial','B',14);
            $pdf->Cell(0,8,utf8_decode("Reporte de Entregas - Departamento: {$dept}"),0,1);
            $pdf->Ln(2);

            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(30,7,'Fecha',1,0,'C');
            $pdf->Cell(70,7,utf8_decode('Centro Educativo'),1,0,'C');
            $pdf->Cell(40,7,utf8_decode('Tipo Alimento'),1,0,'C');
            $pdf->Cell(25,7,'Cantidad',1,0,'C');
            $pdf->Cell(25,7,utf8_decode('Responsable'),1,1,'C');

            $pdf->SetFont('Arial','',9);
            foreach ($items as $it) {
                $pdf->Cell(30,6,$it['fecha_entrega'],1,0);
                $pdf->Cell(70,6,utf8_decode($it['centro_educativo']),1,0);
                $pdf->Cell(40,6,utf8_decode($it['tipo_alimento']),1,0);
                $pdf->Cell(25,6,$it['cantidad_entregada'],1,0,'R');
                $pdf->Cell(25,6,utf8_decode($it['responsable'] ?? ''),1,1);

                if (!empty($it['observaciones'])) {
                    $pdf->SetFont('Arial','I',8);
                    $pdf->Cell(0,5,utf8_decode('Obs: '.$it['observaciones']),1,1);
                    $pdf->SetFont('Arial','',9);
                }
            }
        }

        $pdf->Output('D','reporte_entregas_por_departamento.pdf');
        exit;
    }
}
