<?php
// views/contatos/excluir.php
// Variáveis esperadas: $contato (Contato)
?>

<h2>Confirmar Exclusão</h2>

<p>Tem certeza que deseja excluir o contato abaixo?</p>

<ul style="margin: 16px 0 24px 20px; line-height: 1.8;">
    <li><strong>Nome:</strong> <?= htmlspecialchars($contato->nome) ?></li>
    <li><strong>E-mail:</strong> <?= htmlspecialchars($contato->email) ?></li>
    <li><strong>Telefone:</strong> <?= htmlspecialchars($contato->telefone) ?></li>
</ul>

<form method="POST">
    <div class="actions">
        <button type="submit" class="btn btn-danger" style="background:#e74c3c;border:none;padding:8px 16px;color:#fff;border-radius:4px;cursor:pointer;">Confirmar Exclusão</button>
        <a href="index.php?pagina=contatos" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
