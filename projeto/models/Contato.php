<?php

class Contato
{
    public int    $id       = 0;
    public string $nome     = '';
    public string $email    = '';
    public string $telefone = '';

    public function __construct(array $dados = [])
    {
        if ($dados) {
            $this->id       = (int)   ($dados['id']       ?? 0);
            $this->nome     = (string)($dados['nome']     ?? '');
            $this->email    = (string)($dados['email']    ?? '');
            $this->telefone = (string)($dados['telefone'] ?? '');
        }
    }

    public function validar(): array
    {
        $erros = [];

        if (empty($this->nome)) {
            $erros[] = "Nome é obrigatório.";
        }

        if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $erros[] = "E-mail válido é obrigatório.";
        }

        return $erros;
    }
}
