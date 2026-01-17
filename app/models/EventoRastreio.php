<?php

class EventoRastreio
{
    private PDO $pdo;

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
}

