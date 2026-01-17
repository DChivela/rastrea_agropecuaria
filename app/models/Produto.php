<?php

class Produto
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function listar()
    {
        $sql = "
        SELECT p.*, pr.nome AS produtor
        FROM produtos p
        JOIN produtores pr ON pr.id = p.produtor_id
        ORDER BY p.criado_em DESC
        ";
        return $this->pdo->query($sql)->fetchAll();
    }

    public function buscar(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM produtos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function criar(array $data): bool
    {
        $sql = "
        INSERT INTO produtos (produtor_id, nome, tipo, descricao, unidade)
        VALUES (:produtor_id, :nome, :tipo, :descricao, :unidade)
        ";
        return $this->pdo->prepare($sql)->execute($data);
    }

    public function atualizar(int $id, array $data): bool
    {
        $sql = "
        UPDATE produtos SET
            produtor_id = :produtor_id,
            nome = :nome,
            tipo = :tipo,
            descricao = :descricao,
            unidade = :unidade
        WHERE id = :id
        ";
        $data['id'] = $id;
        return $this->pdo->prepare($sql)->execute($data);
    }

    public function excluir(int $id): bool
    {
        return $this->pdo
            ->prepare("DELETE FROM produtos WHERE id = ?")
            ->execute([$id]);
    }
}

