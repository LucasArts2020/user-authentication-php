# Sistema de Autenticação de Usuários com PHP

Um sistema back-end simples para registo, login e gestão de sessão de usuários, construído com PHP e MySQL.

## 🚀 Sobre o Projeto

Este projeto implementa as funcionalidades essenciais de autenticação de usuários, incluindo:

* Registo (criação) de novos usuários
* Login de usuários existentes
* Logout (encerramento de sessão)
* Proteção de páginas (rotas) que exigem login
* Uso de sessões PHP para manter o usuário conectado
* Armazenamento seguro de senhas (recomenda-se o uso de `password_hash()` e `password_verify()`)

## 🛠️ Tecnologias Utilizadas

* PHP
* MySQL (ou MariaDB)
* HTML5 (para os formulários)
* CSS3 (para estilização básica)

## 🔧 Instalação e Execução

Para executar este projeto localmente, você precisará de um ambiente de servidor local como XAMPP, WAMP ou MAMP.

**1. Clonar o repositório:**
```bash
git clone [https://github.com/LucasArts2020/user-authentication-php.git](https://github.com/LucasArts2020/user-authentication-php.git)
cd user-authentication-php
```

**2. Mover para o servidor local:**
* Mova a pasta do projeto para o diretório `htdocs` (no XAMPP) ou `www` (no WAMP/MAMP).

**3. Configurar o Banco de Dados:**
* Inicie o Apache e o MySQL no seu painel de controle (ex: XAMPP).
* Acesse `http://localhost/phpmyadmin`.
* Crie um novo banco de dados (ex: `auth_db`).
* *(Se você tiver um arquivo .sql para criar as tabelas, importe-o para este banco de dados.)*
* *(Caso contrário, você precisará criar a tabela de usuários. Exemplo:)*
    ```sql
    CREATE TABLE usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE
    );
    ```

**4. Configurar a Conexão:**
* Procure por um arquivo de configuração no projeto (ex: `config.php`, `db.php` ou `conexao.php`).
* Abra este arquivo e edite as variáveis com o nome do seu banco de dados, usuário (geralmente `root`) e senha (geralmente vazia no XAMPP).

**5. Executar o projeto:**
* Acesse o projeto no seu navegador, por exemplo: `http://localhost/user-authentication-php`

