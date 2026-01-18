<?php

class Produtor
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function listar()
    {
        return $this->pdo
            ->query("SELECT * FROM produtores ORDER BY nome")
            ->fetchAll();
    }

    public function buscar(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM produtores WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function criar(array $data): bool
    {
        $sql = "
        INSERT INTO produtores 
        (usuario_id, nome, bi, endereco, cidade, provincia, latitude, longitude, certificacao)
        VALUES 
        (:usuario_id, :nome, :bi, :endereco, :cidade, :provincia, :latitude, :longitude, :certificacao)
        ";
        return $this->pdo->prepare($sql)->execute($data);
    }

    public function atualizar(int $id, array $data): bool
    {
        $sql = "
        UPDATE produtores SET
            usuario_id   = :usuario_id,
            nome         = :nome,
            bi         = :bi,
            endereco     = :endereco,
            cidade       = :cidade,
            provincia       = :provincia,
            latitude     = :latitude,
            longitude    = :longitude,
            certificacao = :certificacao
        WHERE id = :id
        ";
        $data['id'] = $id;
        return $this->pdo->prepare($sql)->execute($data);
    }

    public function excluir(int $id): bool
    {
        return $this->pdo
            ->prepare("DELETE FROM produtores WHERE id = ?")
            ->execute([$id]);
    }
}

