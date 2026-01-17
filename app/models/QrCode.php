<?php

class QrCode
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function gerar(int $loteId): void
    {
        $codigo = bin2hex(random_bytes(8));

        $sql = "INSERT INTO qr_codes (lote_id, codigo)
                VALUES (?, ?)";

        $this->pdo->prepare($sql)->execute([$loteId, $codigo]);
    }
}

