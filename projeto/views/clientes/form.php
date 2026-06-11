<?php
// views/clientes/form.php
// Variáveis esperadas: $cliente (Cliente), $erros (array), $titulo (string)
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
        <input type="text" name="nome" value="<?= htmlspecialchars($cliente->nome) ?>" required>
    </p>

    <p>
        <label>CPF:</label>
        <input type="text" name="cpf" id="cpf" maxlength="14"
               placeholder="000.000.000-00"
               value="<?= htmlspecialchars($cliente->cpf) ?>" required>
    </p>

    <p>
        <label>E-mail:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($cliente->email) ?>" required>
    </p>

    <p>
        <label>Telefone:</label>
        <input type="text" name="telefone" value="<?= htmlspecialchars($cliente->telefone) ?>">
    </p>

    <p>
        <label>Endereço:</label>
        <input type="text" name="endereco" value="<?= htmlspecialchars($cliente->endereco) ?>">
    </p>

    <div class="actions">
        <button type="submit">Salvar</button>
        <a href="index.php?pagina=clientes" class="btn btn-secondary">Cancelar</a>
    </div>

</form>
</div>

<script>
const campoCpf = document.querySelector('#cpf');
if (campoCpf) {
    campoCpf.addEventListener('input', () => {
        let v = campoCpf.value.replace(/\D/g, '');
        v = v.replace(/(\d{3})(\d)/, '$1.$2');
        v = v.replace(/(\d{3})(\d)/, '$1.$2');
        v = v.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        campoCpf.value = v;
    });
}
</script>
