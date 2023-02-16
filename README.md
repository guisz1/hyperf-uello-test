# Introdução

Essa é uma atividade que envolve upload de csv para um ou varios clientes utilizando hyperf e swoole com corotinas.

# Tecnologias

 - php
 - hyperf
 - swoole
 - mysql/mariadb

# Pre-requisitos
 - make
 - docker
   - docker-compose
 - git

# Sobre o makefile
Temos alguns comandos disponiveis que criei para etapa de desenvolvimento e para testes

 - Para subir os containers
   - $ make up
 - Para derrubar os containers
   - $ make dowm
 - Para rodar as migrações
   - $ make migrate
 - Para acessar o container do php
   - $ make php
 - Para acessar o banco de dados
   - $ make db
 - Para criar uma nova migração
   - $ make migration --name=nome_da_nova_migracao(snake_case)
 - Para resetar as migrações 
   - $ make reset
 - Para rodar todos os testes 
   - $ make reset
# Utilizando o projeto
1. baixando o projeto
``git clone https://github.com/guisz1/hyperf-uello-test.git``
1.1 entre na pasta
``cd hyperf-uello-test``
1.2 troque a branch para master
``git checkout master``
1.3 verificamos se esta tudo certo com um pull
``git pull``
1. Criamos o env em seu terminal digite 
``cp .env.example .env``
2. Para iniciar os container basta executar
``make up``

2.1. abrir outro terminal na mesma pasta e logo em seguida instalar as dependencias composer
``make install``

3. Vamos agora criar as tabelas no banco de dados
``make migrate``

Agora se tudo deu certo o projeto já esta up e pronto para utilizar, foi disponibilizado um postman para teste das rotas. ``obs: alterar o ip``

Devemos observar que o upload e processamento do csv esta assincrono, então os dados vão ser disponibilizados aos poucos, se verificar o terminal do docker-compose vera que ele se encontra inserções e com o comando ``SELECT count(*) from freights; `` vera a quantidade aumentando



