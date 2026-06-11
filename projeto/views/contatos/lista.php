<?php
// views/contatos/lista.php
// Variáveis esperadas: $contatos (array de Contato)
?>

<h2>Contatos</h2>

<p><a href="index.php?pagina=contatos&acao=novo" class="btn">+ Novo Contato</a></p>

<?php if (empty($contatos)): ?>
    <p>Nenhum contato cadastrado.</p>
<?php else: ?>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th colspan="2">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($contatos as $i => $contato): ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?= htmlspecialchars($contato->nome) ?></td>
            <td><?= htmlspecialchars($contato->email) ?></td>
            <td><?= htmlspecialchars($contato->telefone) ?></td>
            <td><a href="index.php?pagina=contatos&acao=editar&id=<?= $contato->id ?>" class="btn">Editar</a></td>
            <td><a href="index.php?pagina=contatos&acao=excluir&id=<?= $contato->id ?>" class="btn btn-danger">Excluir</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>
