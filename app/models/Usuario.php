<?php

class Usuario
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function listar()
    {
        return $this->pdo
            ->query("SELECT id, nome_completo, email, telefone, criado_em FROM usuarios ORDER BY nome_completo")
            ->fetchAll();
    }

    public function buscar(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function criar(array $data): bool
    {
        $sql = "
        INSERT INTO usuarios (nome_completo, email, senha, telefone)
        VALUES (:nome_completo, :email, :senha, :telefone)
        ";
        return $this->pdo->prepare($sql)->execute($data);
    }

    public function atualizar(int $id, array $data): bool
    {
        $sql = "
        UPDATE usuarios SET
            nome_completo = :nome_completo,
            email         = :email,
            telefone      = :telefone
        WHERE id = :id
        ";
        $data['id'] = $id;
        return $this->pdo->prepare($sql)->execute($data);
    }

    public function atualizarSenha(int $id, string $senha): bool
    {
        return $this->pdo
            ->prepare("UPDATE usuarios SET senha = ? WHERE id = ?")
            ->execute([$senha, $id]);
    }

    public function excluir(int $id): bool
    {
        return $this->pdo
            ->prepare("DELETE FROM usuarios WHERE id = ?")
            ->execute([$id]);
    }
}

