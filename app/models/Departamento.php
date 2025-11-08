<?php
require_once __DIR__ . '/../core/Model.php';

class Departamento extends Model
{
    protected $table = 'ctl_departamentos';
    protected $pk = 'id_departamento';

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
