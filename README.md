# Agenda — Agenda — Exercício 9: Separação em Camadas

Projeto PHP refatorado com arquitetura em três camadas, inspirada no padrão MVC, desenvolvido como exercício de boas práticas de organização de código.

---

## Estrutura de Pastas

```
projeto/
├── config/
│   ├── database.php        ← Classe Database (Singleton PDO)
│   └── flash.php           ← Sistema de Flash Messages
│
├── models/
│   ├── Contato.php         ← Entidade Contato + validação
│   ├── ContatoDAO.php      ← Queries SQL de contatos
│   ├── Cliente.php         ← Entidade Cliente + validação
│   ├── ClienteDAO.php      ← Queries SQL de clientes
│   ├── Produto.php         ← Entidade Produto + validação
│   └── ProdutoDAO.php      ← Queries SQL de produtos
│
├── views/
│   ├── cabecalho.php       ← Template HTML reutilizável (nav + flash messages)
│   ├── contatos/
│   │   ├── lista.php       ← Listagem de contatos
│   │   └── form.php        ← Formulário de criação/edição
│   ├── clientes/
│   │   ├── lista.php       ← Listagem de clientes
│   │   └── form.php        ← Formulário de criação/edição
│   └── produtos/
│       ├── lista.php       ← Listagem de produtos
│       └── form.php        ← Formulário de criação/edição + upload de imagem
│
├── uploads/                ← Imagens de produtos enviadas pelos usuários
├── index.php               ← Roteador único da aplicação
└── README.md
```

---

## Separação de Responsabilidades

| Camada | Onde | O que faz |
|---|---|---|
| **Banco** | `config/database.php` | Cria e fornece a única conexão PDO (Singleton) |
| **Model** | `models/*.php` | Entidades com validação e DAOs com queries SQL |
| **View** | `views/**/*.php` | Apenas HTML com variáveis PHP simples — sem lógica de banco |
| **Controle** | `index.php` | Roteia requisições, valida dados, chama DAO e inclui a View |

---

## Pré-requisitos

- PHP 8.0 ou superior
- MySQL 5.7+ ou MariaDB
- Servidor web (Apache/Nginx) **ou** PHP built-in server

---

## Como Executar

### 1. Criar o banco de dados

Execute o script SQL abaixo no seu MySQL/MariaDB:

```sql
CREATE DATABASE IF NOT EXISTS agenda
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE agenda;

CREATE TABLE contatos (
    id       INT AUTO_INCREMENT PRIMARY KEY,
    nome     VARCHAR(100) NOT NULL,
    email    VARCHAR(150) NOT NULL,
    telefone VARCHAR(20)
);

CREATE TABLE clientes (
    id       INT AUTO_INCREMENT PRIMARY KEY,
    nome     VARCHAR(100) NOT NULL,
    cpf      VARCHAR(14)  NOT NULL,
    email    VARCHAR(150) NOT NULL,
    telefone VARCHAR(20),
    endereco VARCHAR(255)
);

CREATE TABLE produtos (
    id       INT AUTO_INCREMENT PRIMARY KEY,
    nome     VARCHAR(100)   NOT NULL,
    descricao TEXT,
    preco    DECIMAL(10, 2) NOT NULL,
    estoque  INT            NOT NULL DEFAULT 0,
    imagem   VARCHAR(255)
);
```

### 2. Configurar a conexão

Abra o arquivo `config/database.php` e ajuste as credenciais:

```php
private string $host   = 'localhost';
private string $dbname = 'agenda';
private string $user   = 'root';
private string $pass   = '';
```

### 3. Iniciar o servidor

Na raiz do projeto, execute:

```bash
php -S localhost:8000
```

Acesse no navegador: [http://localhost:8000](http://localhost:8000)

---

## Roteamento

Toda a navegação passa pelo `index.php` via parâmetros GET:

| URL | Ação |
|---|---|
| `index.php` | Lista contatos (página inicial) |
| `index.php?pagina=contatos&acao=novo` | Formulário de novo contato |
| `index.php?pagina=contatos&acao=editar&id=1` | Editar contato #1 |
| `index.php?pagina=contatos&acao=excluir&id=1` | Excluir contato #1 |
| `index.php?pagina=clientes` | Lista clientes |
| `index.php?pagina=clientes&acao=novo` | Formulário de novo cliente |
| `index.php?pagina=clientes&acao=editar&id=1` | Editar cliente #1 |
| `index.php?pagina=clientes&acao=excluir&id=1` | Excluir cliente #1 |
| `index.php?pagina=produtos` | Lista produtos |
| `index.php?pagina=produtos&acao=novo` | Formulário de novo produto |
| `index.php?pagina=produtos&acao=editar&id=1` | Editar produto #1 |
| `index.php?pagina=produtos&acao=excluir&id=1` | Excluir produto #1 |

---

## Funcionalidades

- CRUD completo de **Contatos**
- CRUD completo de **Clientes** (com validação de CPF e formato `000.000.000-00`)
- CRUD completo de **Produtos** com upload de imagem
- **Flash Messages** — mensagens de sucesso/erro exibidas após redirecionamentos (padrão PRG)
- **Singleton Database** — uma única conexão PDO por execução do script
- `try/catch` em todas as operações de banco de dados nos DAOs
- Views sem acesso direto ao banco — apenas HTML com variáveis simples

---

## Padrões e Boas Práticas Aplicadas

- **Singleton** na camada de banco para evitar conexões duplicadas
- **DAO (Data Access Object)** — cada entidade tem sua própria classe de acesso ao banco
- **Prepared Statements** em todas as queries — proteção contra SQL Injection
- **`htmlspecialchars()`** em todas as saídas — proteção contra XSS
- **Flash Messages** via `$_SESSION` para feedback pós-redirect
- **Separação total de camadas** — views nunca acessam `$pdo` diretamente