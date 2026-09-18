# Plataforma de Delivery (CRUD i-Food)

Um sistema de gerenciamento web simples e funcional desenvolvido em **PHP** e **MySQL** para administração de clientes, restaurantes e pedidos de uma plataforma de delivery.

---

## Funcionalidades

O projeto conta com operações CRUD completas (Criar, Ler, Atualizar e Deletar) organizadas nas seguintes seções:

### 1. Gestão de Clientes
- **Cadastrar Cliente**: Registro com nome, e-mail, telefone e endereço.
- **Listar Clientes**: Exibição tabular no painel principal.
- **Editar / Excluir**: Atualização e remoção dos dados dos clientes cadastrados.

### 2. Gestão de Restaurantes
- **Cadastrar Restaurante**: Registro com nome, categoria, telefone e endereço.
- **Listar Restaurantes**: Visualização rápida de todos os estabelecimentos cadastrados.
- **Editar / Excluir**: Manutenção dos dados do restaurante.

### 3. Gestão de Pedidos
- **Cadastrar Pedido**: Criação de pedidos vinculando um cliente e um restaurante cadastrados, informando valor e status inicial.
- **Listar Pedidos**: Visualização geral dos pedidos com relacionamento entre cliente e restaurante (JOIN SQL).
- **Consultar por Cliente**: Filtro para consultar o histórico de pedidos de um cliente específico.
- **Editar / Excluir**: Alteração de status/valor e exclusão de pedidos.

---

## Estrutura do Projeto

```text
i-food/
├── database/
│   └── db.sql                    # Script de criação do banco de dados e tabelas
├── infra/
│   └── conexao.php               # Arquivo de conexão com o banco de dados MySQL
├── public/
│   ├── clientes/
│   │   ├── add_cliente.php       # Formulário e inserção de cliente
│   │   ├── edit_cliente.php      # Edição de cliente
│   │   └── delete_cliente.php    # Exclusão de cliente
│   ├── restaurantes/
│   │   ├── add_restaurante.php   # Formulário e inserção de restaurante
│   │   ├── edit_restaurante.php  # Edição de restaurante
│   │   └── delete_restaurante.php# Exclusão de restaurante
│   └── pedidos/
│       ├── add_pedido.php        # Cadastro de pedido (relaciona cliente e restaurante)
│       ├── edit_pedido.php       # Edição de pedido
│       ├── delete_pedido.php     # Exclusão de pedido
│       └── consulta_cliente.php  # Consulta de pedidos por cliente
├── index.php                     # Painel principal (Dashboard)
└── README.md                     # Documentação do projeto
```

---

## Tecnologias Utilizadas

- **Linguagem**: PHP
- **Banco de Dados**: MySQL
- **Front-end**: HTML5
- **Extensão PHP**: MySQLi

---

## Como Configurar e Executar

### 1. Configuração do Banco de Dados
1. Abra seu gerenciador de banco de dados (MySQL CLI, phpMyAdmin, DBeaver, etc.).
2. Execute os comandos presentes no arquivo [`database/db.sql`](database/db.sql):
   ```sql
   CREATE DATABASE crud_i_food;
   USE crud_i_food;

   CREATE TABLE clientes (
       id INT AUTO_INCREMENT PRIMARY KEY,
       nome VARCHAR(100) NOT NULL,
       email VARCHAR(100) NOT NULL,
       telefone VARCHAR(20),
       endereco VARCHAR(255)
   );

   CREATE TABLE restaurantes (
       id INT AUTO_INCREMENT PRIMARY KEY,
       nome VARCHAR(100) NOT NULL,
       categoria VARCHAR(50),
       telefone VARCHAR(20),
       endereco VARCHAR(255)
   );

   CREATE TABLE pedidos (
       id INT AUTO_INCREMENT PRIMARY KEY,
       cliente_id INT,
       restaurante_id INT,
       data_pedido DATETIME,
       valor DECIMAL(10,2),
       status_p VARCHAR(50),
       FOREIGN KEY (cliente_id) REFERENCES clientes(id),
       FOREIGN KEY (restaurante_id) REFERENCES restaurantes(id)
   );
   ```

### 2. Configuração da Conexão
Edite o arquivo [`infra/conexao.php`](infra/conexao.php) com as credenciais do seu ambiente MySQL:

```php
$host = 'localhost';
$username = 'seu_usuario'; // Ex: 'root'
$pass = 'sua_senha';       // Ex: 'root' ou ''
$dbname = 'crud_i_food';
```

### 3. Executando a Aplicação

#### Opção A: Utilizando o Servidor Embutido do PHP
No terminal, navegue até a pasta raiz do projeto (`i-food`) e execute:
```bash
php -S localhost:8000
```
Acesse `http://localhost:8000` no seu navegador.

#### Opção B: Utilizando XAMPP / WAMP / Laragon
1. Mova a pasta `i-food` para o diretório de documentos do servidor (ex: `htdocs` no XAMPP ou `www` no WAMP).
2. Inicie os serviços do **Apache** e **MySQL**.
3. Acesse `http://localhost/i-food/` no seu navegador.

