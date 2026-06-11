<?php
// views/produtos/lista.php
// Variáveis esperadas: $produtos (array de Produto)
?>

<h2>Produtos</h2>

<p><a href="index.php?pagina=produtos&acao=novo" class="btn">+ Novo Produto</a></p>

<?php if (empty($produtos)): ?>
    <p>Nenhum produto cadastrado.</p>
<?php else: ?>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Estoque</th>
            <th colspan="2">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produtos as $i => $produto): ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td>
                <?php if ($produto->imagem): ?>
                    <img src="uploads/<?= htmlspecialchars($produto->imagem) ?>" width="60" style="border-radius:4px;">
                <?php else: ?>
                    —
                <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($produto->nome) ?></td>
            <td><?= htmlspecialchars($produto->descricao) ?></td>
            <td><?= $produto->precoFormatado() ?></td>
            <td><?= $produto->estoque ?></td>
            <td><a href="index.php?pagina=produtos&acao=editar&id=<?= $produto->id ?>" class="btn">Editar</a></td>
            <td><a href="index.php?pagina=produtos&acao=excluir&id=<?= $produto->id ?>" class="btn btn-danger">Excluir</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>
