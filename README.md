# Introdução

Essa é uma atividade que envolve upload de csv e para um ou varios clientes

# tecnologias

php
hyperf
swoole
mysql/mariadb

# pre-requisitos
 - make
 - docker
   - docker-compose

# sobre o makefile
Temos alguns comandos disponiveis que criei para etapa de desenvolvimento e para testes

Para subir os containers
$ make up
Para derrubar os containers
$ make dowm
Para rodar as migrações
$ make migrate
Para acessar o container do php
$ make php
Para acessar o banco de dados
$ make db
Para criar uma nova migração
$ make migration --name=nome_da_nova_migracao(snake_case)
Para resetar as migrações 
$ make reset
# utilizando o projeto
1. Para iniciar os container basta executar
``make up``

1.1 abrir outro terminal na mesma pasta e logo em seguida instalar as dependencias composer
``make install``

2. Vamos agora criar as tabelas no banco de dados
``make migrate``

Agora se tudo deu certo o projeto já esta up e pronto para utilizar, foi disponibilizado um postman para teste das rotas

Devemos observar que o upload e processamento do csv esta assincrono, então os dados vão ser disponibilizados aos poucos, se verificar o terminal do docker-compose vera que ele se encontra inserções e com o comando ``SELECT count(*) from freights; `` vera a quantidade aumentando



