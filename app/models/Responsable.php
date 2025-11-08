<?php
require_once __DIR__ . '/../core/Model.php';

class Responsable extends Model
{
    protected $table = 'mnt_responsables';
    protected $pk = 'id_responsable';

    public function create($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} (nombre, cargo, telefono) VALUES (:nombre, :cargo, :telefono)");
        return $stmt->execute([
            'nombre' => $data['nombre'],
            'cargo' => $data['cargo'],
            'telefono' => $data['telefono']
        ]);
    }

    public function updateRecord($id, $data)
    {
        $stmt = $this->pdo->prepare("UPDATE {$this->table} SET nombre = :nombre, cargo = :cargo, telefono = :telefono WHERE {$this->pk} = :id");
        return $stmt->execute([
            'nombre' => $data['nombre'],
            'cargo' => $data['cargo'],
            'telefono' => $data['telefono'],
            'id' => $id
        ]);
    }
}
