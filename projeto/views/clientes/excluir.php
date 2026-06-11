<?php
// views/clientes/excluir.php
// Variáveis esperadas: $cliente (Cliente)
?>

<h2>Confirmar Exclusão</h2>

<p>Tem certeza que deseja excluir o cliente abaixo?</p>

<ul style="margin: 16px 0 24px 20px; line-height: 1.8;">
    <li><strong>Nome:</strong> <?= htmlspecialchars($cliente->nome) ?></li>
    <li><strong>CPF:</strong> <?= htmlspecialchars($cliente->cpf) ?></li>
    <li><strong>E-mail:</strong> <?= htmlspecialchars($cliente->email) ?></li>
</ul>

<form method="POST">
    <div class="actions">
        <button type="submit" style="background:#e74c3c;border:none;padding:8px 16px;color:#fff;border-radius:4px;cursor:pointer;">Confirmar Exclusão</button>
        <a href="index.php?pagina=clientes" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
