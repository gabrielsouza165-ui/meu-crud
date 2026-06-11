<?php
// views/produtos/form.php
// Variáveis esperadas: $produto (Produto), $erros (array), $titulo (string)
?>

<h2><?= htmlspecialchars($titulo) ?></h2>

<?php if (!empty($erros)): ?>
    <div class="flash flash-error">
        <?php foreach ($erros as $erro): ?>
            <div><?= htmlspecialchars($erro) ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="form-card">
<form method="POST" enctype="multipart/form-data">

    <p>
        <label>Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($produto->nome) ?>" required>
    </p>

    <p>
        <label>Descrição:</label>
        <textarea name="descricao"><?= htmlspecialchars($produto->descricao) ?></textarea>
    </p>

    <p>
        <label>Preço (R$):</label>
        <input type="number" step="0.01" name="preco" value="<?= $produto->preco ?: '' ?>" required>
    </p>

    <p>
        <label>Estoque:</label>
        <input type="number" name="estoque" value="<?= $produto->estoque ?>" required>
    </p>

    <p>
        <label>Imagem:</label>
        <?php if ($produto->imagem): ?>
            <img src="uploads/<?= htmlspecialchars($produto->imagem) ?>" width="80" style="display:block;margin-bottom:8px;border-radius:4px;">
        <?php endif; ?>
        <input type="file" name="imagem" accept="image/*">
    </p>

    <div class="actions">
        <button type="submit">Salvar</button>
        <a href="index.php?pagina=produtos" class="btn btn-secondary">Cancelar</a>
    </div>

</form>
</div>
