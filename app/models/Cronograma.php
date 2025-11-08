<?php
require_once __DIR__ . '/../core/Model.php';

class Cronograma extends Model
{
    protected $table = 'mnt_cronogramas';
    protected $pk = 'id_cronograma';

    public function create($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} (id_centro, id_alimento, fecha_programada, cantidad_planificada, observaciones) VALUES (:id_centro, :id_alimento, :fecha_programada, :cantidad_planificada, :observaciones)");
        return $stmt->execute([
            'id_centro' => $data['id_centro'],
            'id_alimento' => $data['id_alimento'],
            'fecha_programada' => $data['fecha_programada'],
            'cantidad_planificada' => $data['cantidad_planificada'],
            'observaciones' => $data['observaciones']
        ]);
    }

    public function updateRecord($id, $data)
    {
        $stmt = $this->pdo->prepare("UPDATE {$this->table} SET id_centro = :id_centro, id_alimento = :id_alimento, fecha_programada = :fecha_programada, cantidad_planificada = :cantidad_planificada, observaciones = :observaciones WHERE {$this->pk} = :id");
        return $stmt->execute([
            'id_centro' => $data['id_centro'],
            'id_alimento' => $data['id_alimento'],
            'fecha_programada' => $data['fecha_programada'],
            'cantidad_planificada' => $data['cantidad_planificada'],
            'observaciones' => $data['observaciones'],
            'id' => $id
        ]);
    }
}
