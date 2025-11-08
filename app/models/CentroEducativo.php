<?php
require_once __DIR__ . '/../core/Model.php';

class CentroEducativo extends Model
{
    protected $table = 'mnt_centros_educativos';
    protected $pk = 'id_centro';

    public function create($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} (nombre, id_departamento, cantidad_estudiantes, direccion) VALUES (:nombre, :id_departamento, :cantidad_estudiantes, :direccion)");
        return $stmt->execute([
            'nombre' => $data['nombre'],
            'id_departamento' => $data['id_departamento'],
            'cantidad_estudiantes' => $data['cantidad_estudiantes'],
            'direccion' => $data['direccion']
        ]);
    }

    public function updateRecord($id, $data)
    {
        $stmt = $this->pdo->prepare("UPDATE {$this->table} SET nombre = :nombre, id_departamento = :id_departamento, cantidad_estudiantes = :cantidad_estudiantes, direccion = :direccion WHERE {$this->pk} = :id");
        return $stmt->execute([
            'nombre' => $data['nombre'],
            'id_departamento' => $data['id_departamento'],
            'cantidad_estudiantes' => $data['cantidad_estudiantes'],
            'direccion' => $data['direccion'],
            'id' => $id
        ]);
    }
}
