<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/Produto.php';

class ProdutoDAO
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function listar(): array
    {
        try {
            $stmt = $this->pdo->query("SELECT * FROM produtos ORDER BY nome");
            $rows = $stmt->fetchAll();

            return array_map(fn($r) => new Produto($r), $rows);

        } catch (PDOException $e) {
            throw new RuntimeException("Erro ao listar produtos: " . $e->getMessage());
        }
    }

    public function buscarPorId(int $id): ?Produto
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM produtos WHERE id = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch();

            return $row ? new Produto($row) : null;

        } catch (PDOException $e) {
            throw new RuntimeException("Erro ao buscar produto: " . $e->getMessage());
        }
    }

    public function inserir(Produto $produto): bool
    {
        try {
            $stmt = $this->pdo->prepare(
                "INSERT INTO produtos (nome, descricao, preco, estoque, imagem)
                 VALUES (?, ?, ?, ?, ?)"
            );

            return $stmt->execute([
                $produto->nome,
                $produto->descricao,
                $produto->preco,
                $produto->estoque,
                $produto->imagem,
            ]);

        } catch (PDOException $e) {
            throw new RuntimeException("Erro ao inserir produto: " . $e->getMessage());
        }
    }

    public function atualizar(Produto $produto): bool
    {
        try {
            $stmt = $this->pdo->prepare(
                "UPDATE produtos
                 SET nome = ?, descricao = ?, preco = ?, estoque = ?
                 WHERE id = ?"
            );

            return $stmt->execute([
                $produto->nome,
                $produto->descricao,
                $produto->preco,
                $produto->estoque,
                $produto->id,
            ]);

        } catch (PDOException $e) {
            throw new RuntimeException("Erro ao atualizar produto: " . $e->getMessage());
        }
    }

    public function atualizarComImagem(Produto $produto): bool
    {
        try {
            $stmt = $this->pdo->prepare(
                "UPDATE produtos
                 SET nome = ?, descricao = ?, preco = ?, estoque = ?, imagem = ?
                 WHERE id = ?"
            );

            return $stmt->execute([
                $produto->nome,
                $produto->descricao,
                $produto->preco,
                $produto->estoque,
                $produto->imagem,
                $produto->id,
            ]);

        } catch (PDOException $e) {
            throw new RuntimeException("Erro ao atualizar produto: " . $e->getMessage());
        }
    }

    public function excluir(int $id): bool
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM produtos WHERE id = ?");
            return $stmt->execute([$id]);

        } catch (PDOException $e) {
            throw new RuntimeException("Erro ao excluir produto: " . $e->getMessage());
        }
    }
}

