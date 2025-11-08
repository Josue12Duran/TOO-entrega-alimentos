<?php
class Model
{
    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function all()
    {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll();
    }

    public function find($id, $pk = 'id')
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE {$pk} = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function delete($id, $pk = 'id')
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE {$pk} = :id");
        return $stmt->execute(['id' => $id]);
    }
}
