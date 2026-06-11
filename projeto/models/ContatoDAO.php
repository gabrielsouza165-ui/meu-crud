<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/Contato.php';

class ContatoDAO
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function listar(): array
    {
        try {
            $stmt = $this->pdo->query("SELECT * FROM contatos ORDER BY nome");
            $rows = $stmt->fetchAll();

            return array_map(fn($r) => new Contato($r), $rows);

        } catch (PDOException $e) {
            throw new RuntimeException("Erro ao listar contatos: " . $e->getMessage());
        }
    }

    public function buscarPorId(int $id): ?Contato
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM contatos WHERE id = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch();

            return $row ? new Contato($row) : null;

        } catch (PDOException $e) {
            throw new RuntimeException("Erro ao buscar contato: " . $e->getMessage());
        }
    }

    public function inserir(Contato $contato): bool
    {
        try {
            $stmt = $this->pdo->prepare(
                "INSERT INTO contatos (nome, email, telefone) VALUES (?, ?, ?)"
            );

            return $stmt->execute([
                $contato->nome,
                $contato->email,
                $contato->telefone,
            ]);

        } catch (PDOException $e) {
            throw new RuntimeException("Erro ao inserir contato: " . $e->getMessage());
        }
    }

    public function atualizar(Contato $contato): bool
    {
        try {
            $stmt = $this->pdo->prepare(
                "UPDATE contatos SET nome = ?, email = ?, telefone = ? WHERE id = ?"
            );

            return $stmt->execute([
                $contato->nome,
                $contato->email,
                $contato->telefone,
                $contato->id,
            ]);

        } catch (PDOException $e) {
            throw new RuntimeException("Erro ao atualizar contato: " . $e->getMessage());
        }
    }

    public function excluir(int $id): bool
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM contatos WHERE id = ?");
            return $stmt->execute([$id]);

        } catch (PDOException $e) {
            throw new RuntimeException("Erro ao excluir contato: " . $e->getMessage());
        }
    }
}
