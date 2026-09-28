# Agenda 08 - Lista de Amigos da Gabi

Projeto didático desenvolvido para a disciplina **Desenvolvimento de Sistemas II**, reunindo o CRUD da Lista de Amigos com o sistema de **login, sessão, proteção de acesso e logout** trabalhado na Agenda 08.

## Tecnologias utilizadas

- PHP 8.x
- MySQL / MariaDB
- MySQLi
- HTML5
- W3.CSS
- Font Awesome
- XAMPP no Windows

## Funcionalidades

O fluxo principal do sistema é:

**Login → Página principal → Cadastrar amigo → Listar amigos → Editar → Excluir → Logout**

O projeto possui:

- login com usuário e senha;
- sessão com `$_SESSION['logado']`;
- bloqueio de páginas protegidas quando o usuário não está autenticado;
- cadastro de amigos;
- listagem dos amigos cadastrados;
- edição dos dados de um amigo;
- exclusão com confirmação;
- logout e retorno à tela de login;
- conexão com o banco centralizada em `conexaoBD.php`;
- reutilização de cabeçalho e rodapé com `require_once`.

## 1. Instalação no XAMPP

1. Instale e abra o **XAMPP**.
2. Inicie os serviços **Apache** e **MySQL**.
3. Copie a pasta `Agenda08_ListaAmigos` para:

```text
C:\xampp\htdocs\
```

O caminho final deve ficar parecido com:

```text
C:\xampp\htdocs\Agenda08_ListaAmigos\
```

## 2. Criar o banco de dados

1. Abra o navegador.
2. Acesse o **phpMyAdmin** pelo painel do XAMPP ou pelo endereço `http://localhost/phpmyadmin/`.
3. Escolha a opção **Importar**.
4. Selecione o arquivo:

```text
banco/agenda08_lista_amigos.sql
```

5. Clique em **Importar/Executar**.

O script cria o banco **`pwii`**, as tabelas `usuario` e `amigo` e o usuário de teste.

## 3. Usuário para login

Use as credenciais abaixo:

```text
Usuário: gabi
Senha: gabi123
```

A senha foi mantida em texto simples somente porque o projeto acompanha a abordagem didática apresentada na Agenda 08. Em um sistema de produção, o correto seria armazenar senhas com hash.

## 4. Executar o projeto

Com Apache e MySQL iniciados, abra:

```text
http://localhost/Agenda08_ListaAmigos/
```

Faça o login com `gabi` / `gabi123`.

## 5. Como demonstrar o CRUD

### Cadastrar

Na página principal, clique em **Cadastrar amigo**. Preencha nome, sobrenome, telefone e e-mail e clique em **Salvar amigo**.

### Listar

Clique em **Listar amigos** para visualizar todos os registros cadastrados.

### Editar

Na tabela de amigos, clique em **Editar**. Altere os dados desejados e clique em **Salvar alterações**.

### Excluir

Na tabela, clique em **Excluir**. O navegador solicitará confirmação antes de remover o registro.

### Logout

Na página principal, clique em **Logout**. A variável de sessão é removida e o sistema volta para a tela de login. Se alguém tentar acessar diretamente uma página protegida sem login, será direcionado para a tela de acesso negado.

## Apresentação final

A apresentação usada para entrega da atividade está disponível em:

```text
apresentacao/Apresentacao_Final_Agenda08_Lista_de_Amigos_da_Gabi.pptx
```

Ela apresenta o fluxo completo do projeto com capturas reais do sistema funcionando no XAMPP: login, autenticação, página principal, cadastro, listagem, edição, exclusão, logout e bloqueio de acesso sem sessão.

## Estrutura principal

```text
Agenda08_ListaAmigos/
├── index.php
├── loginAction.php
├── logoutAction.php
├── verificarAcesso.php
├── acessoNegado.php
├── principal.php
├── cadastro.php
├── cadastroAction.php
├── listar.php
├── editar.php
├── editarAction.php
├── excluir.php
├── conexaoBD.php
├── cabecalho.php
├── rodape.php
├── banco/
│   └── agenda08_lista_amigos.sql
├── apresentacao/
│   └── Apresentacao_Final_Agenda08_Lista_de_Amigos_da_Gabi.pptx
└── tests/
    └── verify_structure.php
```

## Observação sobre a conexão com o MySQL

O arquivo `conexaoBD.php` está configurado para o padrão mais comum do XAMPP local:

```text
Servidor: localhost
Usuário: root
Senha: vazia
Banco: pwii
```

Se o seu MySQL possuir senha para o usuário `root`, altere apenas a variável `$password` em `conexaoBD.php`.

## Teste estrutural

Se o PHP estiver disponível no terminal, é possível executar:

```bash
php tests/verify_structure.php
```

O teste confere a presença dos arquivos, partes principais do login, proteção de sessão, CRUD, banco e documentação.

## Finalidade acadêmica

O sistema foi construído para demonstrar os conteúdos estudados no curso. Por isso, a organização foi mantida simples e próxima dos exemplos da disciplina, facilitando a explicação do projeto durante a apresentação.
