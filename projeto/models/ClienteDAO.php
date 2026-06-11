<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/Cliente.php';

class ClienteDAO
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function listar(): array
    {
        try {
            $stmt = $this->pdo->query("SELECT * FROM clientes ORDER BY nome");
            $rows = $stmt->fetchAll();

            return array_map(fn($r) => new Cliente($r), $rows);

        } catch (PDOException $e) {
            throw new RuntimeException("Erro ao listar clientes: " . $e->getMessage());
        }
    }

    public function buscarPorId(int $id): ?Cliente
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE id = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch();

            return $row ? new Cliente($row) : null;

        } catch (PDOException $e) {
            throw new RuntimeException("Erro ao buscar cliente: " . $e->getMessage());
        }
    }

    public function inserir(Cliente $cliente): bool
    {
        try {
            $stmt = $this->pdo->prepare(
                "INSERT INTO clientes (nome, cpf, email, telefone, endereco)
                 VALUES (?, ?, ?, ?, ?)"
            );

            return $stmt->execute([
                $cliente->nome,
                $cliente->cpf,
                $cliente->email,
                $cliente->telefone,
                $cliente->endereco,
            ]);

        } catch (PDOException $e) {
            throw new RuntimeException("Erro ao inserir cliente: " . $e->getMessage());
        }
    }

    public function atualizar(Cliente $cliente): bool
    {
        try {
            $stmt = $this->pdo->prepare(
                "UPDATE clientes
                 SET nome = ?, cpf = ?, email = ?, telefone = ?, endereco = ?
                 WHERE id = ?"
            );

            return $stmt->execute([
                $cliente->nome,
                $cliente->cpf,
                $cliente->email,
                $cliente->telefone,
                $cliente->endereco,
                $cliente->id,
            ]);

        } catch (PDOException $e) {
            throw new RuntimeException("Erro ao atualizar cliente: " . $e->getMessage());
        }
    }

    public function excluir(int $id): bool
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM clientes WHERE id = ?");
            return $stmt->execute([$id]);

        } catch (PDOException $e) {
            throw new RuntimeException("Erro ao excluir cliente: " . $e->getMessage());
        }
    }
}
