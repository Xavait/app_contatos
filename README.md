CRUD de Contatos com Exclusão Suave e AJAX
Este é um projeto de exemplo em Laravel 10 que permite criar, editar, visualizar, e excluir contatos com exclusão suave. O projeto utiliza AJAX para a exclusão, garantindo uma experiência de usuário mais fluída, e SweetAlert para mostrar as mensagens de confirmação e erro.

Funcionalidades
Listagem de Contatos: Página para visualizar todos os contatos cadastrados.
Criar Contato: Formulário para adicionar novos contatos.
Editar Contato: Editar informações de um contato existente.
Visualizar Detalhes: Visualizar os detalhes de um contato específico.
Exclusão Suave: Excluir contatos sem removê-los fisicamente da base de dados (soft delete).
Autenticação: Só usuários autenticados podem criar, editar, excluir ou visualizar detalhes dos contatos.
Requisitos
PHP 8.1 ou superior
Laravel 10
MySQL ou outro banco de dados compatível com Laravel
Composer
Node.js e NPM (para compilação de recursos front-end)
Instalação
1. Clonando o Repositório
Primeiro, clone este repositório para sua máquina local:

git clone https://github.com/seu-usuario/seu-repositorio.git
2. Instalando Dependências
Dentro da pasta do projeto, execute o seguinte comando para instalar as dependências do Laravel e do Composer:

composer install
Em seguida, instale as dependências do front-end:
npm install

3. Configurando o Ambiente
Em seguida, gere a chave de aplicativo do Laravel:
php artisan key:generate

4. Configurando o Banco de Dados
Abra o arquivo .env e configure as credenciais do banco de dados

5. Executando as Migrations
Execute as migrations para criar as tabelas necessárias no banco de dados:
php artisan migrate
php artisan db:seed

6. Servindo o Projeto
Agora, você pode rodar o servidor embutido do Laravel:
php artisan serve
