<?php
require_once __DIR__ . '/../core/Model.php';

class TipoAlimento extends Model
{
    protected $table = 'ctl_tipos_alimentos';
    protected $pk = 'id_alimento';

    public function create($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} (nombre) VALUES (:nombre)");
        return $stmt->execute(['nombre' => $data['nombre']]);
    }

    public function updateRecord($id, $data)
    {
        $stmt = $this->pdo->prepare("UPDATE {$this->table} SET nombre = :nombre WHERE {$this->pk} = :id");
        return $stmt->execute(['nombre' => $data['nombre'], 'id' => $id]);
    }
}
