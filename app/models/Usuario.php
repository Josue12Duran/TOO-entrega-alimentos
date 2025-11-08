<?php
require_once __DIR__ . '/../core/Model.php';

class Usuario extends Model
{
    protected $table = 'mnt_usuarios';
    protected $pk = 'id';

    public function create($data)
    {
        $hash = password_hash($data['password'], PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} (usuario, password, nombre_completo, rol) VALUES (:usuario, :password, :nombre_completo, :rol)");
        return $stmt->execute([
            'usuario' => $data['usuario'],
            'password' => $hash,
            'nombre_completo' => $data['nombre_completo'],
            'rol' => $data['rol']
        ]);
    }

    public function updateRecord($id, $data)
    {
        if (!empty($data['password'])) {
            $hash = password_hash($data['password'], PASSWORD_DEFAULT);
            $stmt = $this->pdo->prepare("UPDATE {$this->table} SET usuario = :usuario, password = :password, nombre_completo = :nombre_completo, rol = :rol WHERE {$this->pk} = :id");
            return $stmt->execute([
                'usuario' => $data['usuario'],
                'password' => $hash,
                'nombre_completo' => $data['nombre_completo'],
                'rol' => $data['rol'],
                'id' => $id
            ]);
        } else {
            $stmt = $this->pdo->prepare("UPDATE {$this->table} SET usuario = :usuario, nombre_completo = :nombre_completo, rol = :rol WHERE {$this->pk} = :id");
            return $stmt->execute([
                'usuario' => $data['usuario'],
                'nombre_completo' => $data['nombre_completo'],
                'rol' => $data['rol'],
                'id' => $id
            ]);
        }
    }

    public function findByUsername($usuario)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE usuario = :u LIMIT 1");
        $stmt->execute(['u' => $usuario]);
        return $stmt->fetch();
    }
}
