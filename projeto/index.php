<?php
session_start();

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/models/Contato.php';
require_once __DIR__ . '/models/ContatoDAO.php';
require_once __DIR__ . '/models/Cliente.php';
require_once __DIR__ . '/models/ClienteDAO.php';
require_once __DIR__ . '/models/Produto.php';
require_once __DIR__ . '/models/ProdutoDAO.php';

$pagina = $_GET['pagina'] ?? 'contatos';
$acao   = $_GET['acao']   ?? 'listar';
$id     = (int)($_GET['id'] ?? 0);
$post   = $_SERVER['REQUEST_METHOD'] === 'POST';

function view(string $template, array $vars = []): void
{
    extract($vars);
    include __DIR__ . '/views/cabecalho.php';
    include __DIR__ . "/views/{$template}";
    include __DIR__ . '/views/rodape.php';
}

function redirect(string $pagina): never
{
    header("Location: index.php?pagina={$pagina}");
    exit;
}

function uploadImagem(): ?string
{
    if (empty($_FILES['imagem']['name'])) return null;

    $ext  = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
    $mime = mime_content_type($_FILES['imagem']['tmp_name']);

    if (!in_array($ext,  ['jpg','jpeg','png','webp'])) throw new RuntimeException("Extensão não permitida.");
    if (!in_array($mime, ['image/jpeg','image/png','image/webp'])) throw new RuntimeException("Tipo de arquivo inválido.");

    if (!is_dir(__DIR__ . '/uploads')) mkdir(__DIR__ . '/uploads', 0777, true);

    $nome = uniqid('prod_') . '.' . $ext;
    move_uploaded_file($_FILES['imagem']['tmp_name'], __DIR__ . '/uploads/' . $nome)
        or throw new RuntimeException("Falha ao salvar imagem.");

    return $nome;
}

//contatos

if ($pagina === 'contatos') {
    $dao = new ContatoDAO();

    if ($acao === 'listar') {
        view('contatos/lista.php', ['contatos' => $dao->listar()]);

    } elseif ($acao === 'novo' || $acao === 'editar') {
        $contato = $acao === 'editar' ? ($dao->buscarPorId($id) ?? redirect('contatos')) : new Contato();
        $erros   = [];
        $titulo  = $acao === 'novo' ? 'Novo Contato' : 'Editar Contato';

        if ($post) {
            $contato->nome     = trim($_POST['nome']     ?? '');
            $contato->email    = trim($_POST['email']    ?? '');
            $contato->telefone = trim($_POST['telefone'] ?? '');
            $erros = $contato->validar();

            if (!$erros) {
                $acao === 'novo' ? $dao->inserir($contato) : $dao->atualizar($contato);
                redirect('contatos');
            }
        }
        view('contatos/form.php', compact('contato', 'erros', 'titulo'));

    } elseif ($acao === 'excluir') {
        $contato = $dao->buscarPorId($id) ?? redirect('contatos');
        if ($post) { $dao->excluir($id); redirect('contatos'); }
        view('contatos/excluir.php', compact('contato'));
    }
}

//clientes

elseif ($pagina === 'clientes') {
    $dao = new ClienteDAO();

    if ($acao === 'listar') {
        view('clientes/lista.php', ['clientes' => $dao->listar()]);

    } elseif ($acao === 'novo' || $acao === 'editar') {
        $cliente = $acao === 'editar' ? ($dao->buscarPorId($id) ?? redirect('clientes')) : new Cliente();
        $erros   = [];
        $titulo  = $acao === 'novo' ? 'Novo Cliente' : 'Editar Cliente';

        if ($post) {
            $cliente->nome     = trim($_POST['nome']     ?? '');
            $cliente->cpf      = trim($_POST['cpf']      ?? '');
            $cliente->email    = trim($_POST['email']    ?? '');
            $cliente->telefone = trim($_POST['telefone'] ?? '');
            $cliente->endereco = trim($_POST['endereco'] ?? '');
            $erros = $cliente->validar();

            if (!$erros) {
                $acao === 'novo' ? $dao->inserir($cliente) : $dao->atualizar($cliente);
                redirect('clientes');
            }
        }
        view('clientes/form.php', compact('cliente', 'erros', 'titulo'));

    } elseif ($acao === 'excluir') {
        $cliente = $dao->buscarPorId($id) ?? redirect('clientes');
        if ($post) { $dao->excluir($id); redirect('clientes'); }
        view('clientes/excluir.php', compact('cliente'));
    }
}

//produtos

elseif ($pagina === 'produtos') {
    $dao = new ProdutoDAO();

    if ($acao === 'listar') {
        view('produtos/lista.php', ['produtos' => $dao->listar()]);

    } elseif ($acao === 'novo' || $acao === 'editar') {
        $produto = $acao === 'editar' ? ($dao->buscarPorId($id) ?? redirect('produtos')) : new Produto();
        $erros   = [];
        $titulo  = $acao === 'novo' ? 'Novo Produto' : 'Editar Produto';

        if ($post) {
            $produto->nome      = trim($_POST['nome']      ?? '');
            $produto->descricao = trim($_POST['descricao'] ?? '');
            $produto->preco     = floatval($_POST['preco']  ?? 0);
            $produto->estoque   = intval($_POST['estoque']  ?? 0);
            $erros = $produto->validar();

            if (!$erros) {
                try {
                    $nova = uploadImagem();
                    if ($nova) {
                        if ($produto->imagem) @unlink(__DIR__ . '/uploads/' . $produto->imagem);
                        $produto->imagem = $nova;
                        $dao->atualizarComImagem($produto);
                    } else {
                        $acao === 'novo' ? $dao->inserir($produto) : $dao->atualizar($produto);
                    }
                    redirect('produtos');
                } catch (RuntimeException $e) {
                    $erros[] = $e->getMessage();
                }
            }
        }
        view('produtos/form.php', compact('produto', 'erros', 'titulo'));

    } elseif ($acao === 'excluir') {
        $produto = $dao->buscarPorId($id) ?? redirect('produtos');
        if ($post) {
            if ($produto->imagem) @unlink(__DIR__ . '/uploads/' . $produto->imagem);
            $dao->excluir($id);
            redirect('produtos');
        }
        view('produtos/excluir.php', compact('produto'));
    }
}

else {
    view('contatos/lista.php', ['contatos' => (new ContatoDAO())->listar()]);
}
