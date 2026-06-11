<?php
// views/clientes/lista.php
// Variáveis esperadas: $clientes (array de Cliente)
?>

<h2>Clientes</h2>

<p><a href="index.php?pagina=clientes&acao=novo" class="btn">+ Novo Cliente</a></p>

<?php if (empty($clientes)): ?>
    <p>Nenhum cliente cadastrado.</p>
<?php else: ?>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Endereço</th>
            <th colspan="2">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clientes as $i => $cliente): ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?= htmlspecialchars($cliente->nome) ?></td>
            <td><?= htmlspecialchars($cliente->cpf) ?></td>
            <td><?= htmlspecialchars($cliente->email) ?></td>
            <td><?= htmlspecialchars($cliente->telefone) ?></td>
            <td><?= htmlspecialchars($cliente->endereco) ?></td>
            <td><a href="index.php?pagina=clientes&acao=editar&id=<?= $cliente->id ?>" class="btn">Editar</a></td>
            <td><a href="index.php?pagina=clientes&acao=excluir&id=<?= $cliente->id ?>" class="btn btn-danger">Excluir</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>
