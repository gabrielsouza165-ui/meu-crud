<?php
// views/contatos/form.php
// Variáveis esperadas: $contato (Contato), $erros (array), $titulo (string)
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
<form method="POST">

    <p>
        <label>Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($contato->nome) ?>" required>
    </p>

    <p>
        <label>E-mail:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($contato->email) ?>" required>
    </p>

    <p>
        <label>Telefone:</label>
        <input type="text" name="telefone" value="<?= htmlspecialchars($contato->telefone) ?>">
    </p>

    <div class="actions">
        <button type="submit">Salvar</button>
        <a href="index.php?pagina=contatos" class="btn btn-secondary">Cancelar</a>
    </div>

</form>
</div>
