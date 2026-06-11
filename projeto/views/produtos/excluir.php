<?php
// views/produtos/excluir.php
// Variáveis esperadas: $produto (Produto)
?>

<h2>Confirmar Exclusão</h2>

<p>Tem certeza que deseja excluir o produto abaixo?</p>

<?php if ($produto->imagem): ?>
    <img src="uploads/<?= htmlspecialchars($produto->imagem) ?>" width="120"
         style="display:block;margin:16px 0;border-radius:6px;">
<?php endif; ?>

<ul style="margin: 16px 0 24px 20px; line-height: 1.8;">
    <li><strong>Nome:</strong> <?= htmlspecialchars($produto->nome) ?></li>
    <li><strong>Preço:</strong> <?= $produto->precoFormatado() ?></li>
    <li><strong>Estoque:</strong> <?= $produto->estoque ?></li>
</ul>

<form method="POST">
    <div class="actions">
        <button type="submit" style="background:#e74c3c;border:none;padding:8px 16px;color:#fff;border-radius:4px;cursor:pointer;">Confirmar Exclusão</button>
        <a href="index.php?pagina=produtos" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
