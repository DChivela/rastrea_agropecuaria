<?php

class Lote
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function listarPorProduto(int $produtoId)
    {
        $stmt = $this->pdo->prepare("
            SELECT * FROM lotes 
            WHERE produto_id = ?
            ORDER BY criado_em DESC
        ");
        $stmt->execute([$produtoId]);
        return $stmt->fetchAll();
    }

    public function buscar(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM lotes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function criar(array $data): bool
    {
        $sql = "
        INSERT INTO lotes
        (produto_id, codigo_lote, quantidade, data_producao, data_validade, local_origem)
        VALUES
        (:produto_id, :codigo_lote, :quantidade, :data_producao, :data_validade, :local_origem)
        ";
        return $this->pdo->prepare($sql)->execute($data);
    }

    public function atualizar(int $id, array $data): bool
    {
        $sql = "
        UPDATE lotes SET
            quantidade = :quantidade,
            data_validade = :data_validade,
            status = :status,
            local_atual = :local_atual
        WHERE id = :id
        ";
        $data['id'] = $id;
        return $this->pdo->prepare($sql)->execute($data);
    }

    public function excluir(int $id): bool
    {
        return $this->pdo
            ->prepare("DELETE FROM lotes WHERE id = ?")
            ->execute([$id]);
    }
}
