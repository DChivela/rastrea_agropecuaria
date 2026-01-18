<?php

class EventoRastreio
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function listarPorLote(int $loteId)
    {
        $stmt = $this->pdo->prepare("
            SELECT * FROM eventos_rastreio
            WHERE lote_id = ?
            ORDER BY data_evento DESC
        ");
        $stmt->execute([$loteId]);
        return $stmt->fetchAll();
    }

    public function criar(array $data): bool
    {
        $sql = "
        INSERT INTO eventos_rastreio
        (lote_id, tipo_evento, descricao, localizacao, temperatura, umidade, responsavel)
        VALUES
        (:lote_id, :tipo_evento, :descricao, :localizacao, :temperatura, :umidade, :responsavel)
        ";
        return $this->pdo->prepare($sql)->execute($data);
    }

    public function atualizar(int $id, array $data): bool
    {
        $sql = "
        UPDATE eventos_rastreio SET
            tipo_evento = :tipo_evento,
            descricao   = :descricao,
            localizacao = :localizacao,
            temperatura = :temperatura,
            umidade     = :umidade,
            responsavel = :responsavel
        WHERE id = :id
        ";
        $data['id'] = $id;
        return $this->pdo->prepare($sql)->execute($data);
    }

    public function excluir(int $id): bool
    {
        return $this->pdo
            ->prepare("DELETE FROM eventos_rastreio WHERE id = ?")
            ->execute([$id]);
    }
}
