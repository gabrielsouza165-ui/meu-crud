<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: sans-serif; background: #f5f5f5; color: #333; }
        nav { background: #2c3e50; padding: 12px 24px; display: flex; gap: 20px; }
        nav a { color: #ecf0f1; text-decoration: none; font-size: 15px; }
        nav a:hover { color: #3498db; }
        main { max-width: 960px; margin: 30px auto; padding: 0 20px; }
        h2 { margin-bottom: 20px; color: #2c3e50; }
        table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 6px; overflow: hidden; box-shadow: 0 1px 4px rgba(0,0,0,.1); }
        th, td { padding: 10px 14px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #2c3e50; color: #fff; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #f9f9f9; }
        a.btn, button { display: inline-block; padding: 8px 16px; background: #3498db; color: #fff; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; font-size: 14px; }
        a.btn:hover, button:hover { background: #2980b9; }
        a.btn-danger { background: #e74c3c; }
        a.btn-danger:hover { background: #c0392b; }
        a.btn-secondary { background: #7f8c8d; }
        a.btn-secondary:hover { background: #636e72; }
        form p { margin-bottom: 14px; }
        form label { display: block; margin-bottom: 4px; font-weight: bold; color: #555; }
        input[type=text], input[type=email], input[type=number], input[type=file], textarea {
            width: 100%; padding: 8px 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;
        }
        textarea { height: 90px; resize: vertical; }
        .form-card { background: #fff; padding: 24px; border-radius: 6px; box-shadow: 0 1px 4px rgba(0,0,0,.1); max-width: 480px; }
        .actions { display: flex; gap: 8px; }
        .flash { padding: 12px 16px; border-radius: 4px; margin-bottom: 20px; }
        .flash-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
<nav>
    <a href="index.php">🏠 Início</a>
    <a href="index.php?pagina=contatos">Contatos</a>
    <a href="index.php?pagina=clientes">Clientes</a>
    <a href="index.php?pagina=produtos">Produtos</a>
</nav>
<main>
