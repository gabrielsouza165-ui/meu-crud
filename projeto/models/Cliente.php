<?php

class Cliente
{
    public int    $id       = 0;
    public string $nome     = '';
    public string $cpf      = '';
    public string $email    = '';
    public string $telefone = '';
    public string $endereco = '';

    public function __construct(array $dados = [])
    {
        if ($dados) {
            $this->id       = (int)   ($dados['id']       ?? 0);
            $this->nome     = (string)($dados['nome']     ?? '');
            $this->cpf      = (string)($dados['cpf']      ?? '');
            $this->email    = (string)($dados['email']    ?? '');
            $this->telefone = (string)($dados['telefone'] ?? '');
            $this->endereco = (string)($dados['endereco'] ?? '');
        }
    }

    public function validar(): array
    {
        $erros = [];

        if (empty($this->nome)) {
            $erros[] = "Nome é obrigatório.";
        }

        if (empty($this->cpf)) {
            $erros[] = "CPF é obrigatório.";
        } elseif (!preg_match('/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/', $this->cpf)) {
            $erros[] = "CPF inválido. Use o formato 000.000.000-00.";
        }

        if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $erros[] = "E-mail válido é obrigatório.";
        }

        return $erros;
    }
}
