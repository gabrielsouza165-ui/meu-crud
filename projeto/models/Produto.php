<?php

class Produto
{
    public int    $id       = 0;
    public string $nome     = '';
    public string $descricao = '';
    public float  $preco    = 0.0;
    public int    $estoque  = 0;
    public ?string $imagem  = null;

    public function __construct(array $dados = [])
    {
        if ($dados) {
            $this->id       = (int)   ($dados['id']       ?? 0);
            $this->nome     = (string)($dados['nome']     ?? '');
            $this->descricao = (string)($dados['descricao'] ?? '');
            $this->preco    = (float) ($dados['preco']    ?? 0);
            $this->estoque  = (int)   ($dados['estoque']  ?? 0);
            $this->imagem   =          $dados['imagem']   ?? null;
        }
    }

    public function validar(): array
    {
        $erros = [];

        if (empty($this->nome)) {
            $erros[] = "Nome é obrigatório.";
        }

        if ($this->preco <= 0) {
            $erros[] = "Preço deve ser maior que zero.";
        }

        if ($this->estoque < 0) {
            $erros[] = "Estoque não pode ser negativo.";
        }

        return $erros;
    }

    public function precoFormatado(): string
    {
        return 'R$ ' . number_format($this->preco, 2, ',', '.');
    }
}
