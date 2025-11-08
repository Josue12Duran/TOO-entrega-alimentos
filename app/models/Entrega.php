<?php
require_once __DIR__ . '/../core/Model.php';

class Entrega extends Model
{
    protected $table = 'mnt_entregas';
    protected $pk = 'id_entrega';

    public function create($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} (id_centro, id_alimento, id_responsable, fecha_entrega, cantidad_entregada, observaciones) VALUES (:id_centro, :id_alimento, :id_responsable, :fecha_entrega, :cantidad_entregada, :observaciones)");
        return $stmt->execute([
            'id_centro' => $data['id_centro'],
            'id_alimento' => $data['id_alimento'],
            'id_responsable' => $data['id_responsable'] ?: null,
            'fecha_entrega' => $data['fecha_entrega'],
            'cantidad_entregada' => $data['cantidad_entregada'],
            'observaciones' => $data['observaciones']
        ]);
    }

    public function updateRecord($id, $data)
    {
        $stmt = $this->pdo->prepare("UPDATE {$this->table} SET id_centro = :id_centro, id_alimento = :id_alimento, id_responsable = :id_responsable, fecha_entrega = :fecha_entrega, cantidad_entregada = :cantidad_entregada, observaciones = :observaciones WHERE {$this->pk} = :id");
        return $stmt->execute([
            'id_centro' => $data['id_centro'],
            'id_alimento' => $data['id_alimento'],
            'id_responsable' => $data['id_responsable'] ?: null,
            'fecha_entrega' => $data['fecha_entrega'],
            'cantidad_entregada' => $data['cantidad_entregada'],
            'observaciones' => $data['observaciones'],
            'id' => $id
        ]);
    }
}
