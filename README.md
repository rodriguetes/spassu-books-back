
# BOOK API - Laravel + DOCKER + CHATGPT

## Sobre o Projeto

Criar um projeto utilizando as boas práticas de mercado e apresentar o mesmo demonstrando o passo a passo de sua criação (base de dados, tecnologias, aplicação, metodologias, frameworks, etc).
O projeto consiste em um cadastro de livros.

- Deve ser feito CRUD para Livro, Autor e Assunto conforme o modelo de dados.
- Deve ser feito obrigatoriamente um relatório (utilizando o componente de relatórios de sua preferência(Crystal, ReportViewer, etc)) e a consulta desse relatório deve ser proveniente de uma view criada no banco de dados. Este relatório pode ser simples, mas permita o entendimento dos dados. O relatório deve trazer as informações das 3 tabelas principais agrupando os dados por autor (atenção pois um livro pode ter mais de autor).
- TDD (Test Driven Development) será considerados um diferencial.

## Tecnologias utilizadas

- Laravel Sail
- Docker
- API OPENAI CHATGPT
- Clean Architecture
- Laravel V.10.2.0
- Composer version 2.5.4
- PHP 8.1
- MySql 8.0
- SOLID
- PSR4
- Mailpit

## Recursos
Foi utilizado alguns recursos do laravel para o teste como por exemplo:

- Api Resource
- Camada de Service 
- Interface
- Pattern Repository
- Request
- Teste Unitario (PHPUnit)
- Teste Feature 
- Traits
- Migrate
- Envio de Email

## Iniciando o projeto

- Clonar repositório
```shell
git clone https://github.com/rodriguetes/spassu-books-back.git
````

- Após clonar o repositorio, basta rodar o comando abaixo, para subir os container. Obs: Foi utilizado o *Laravel Sail*, desenvolvimento do mesmo, por se tratar de uma configuração rápida com Docker:
```shell
./vendor/bin/sail up
````

- Executar composer:
```shell
sail composer install
````

- Gerar Key Laravel:
```shell
sail artisan key:generate
````

- Rodar Migrates:
```shell
sail artisan migrate
````

- Rodar Testes:
```shell
sail artisan test
````

### Acesso ao Projeto
```bash
http://localhost:80
````


### Endpoints
**Na pasta database do projeto se encontra as collection para se usar no Postman**
```bash
Spassu - Books.postman_collection.json
````

### Emails
**Por se tratar de um teste o sistema ira disparar os emails que serao recebidos usando mailpit que ja vem configurado por padrão no projeto do laravel utilizando o Sail, basta acessar a url
[`http://localhost:8025`](http://localhost:8025)

**Para que ocorra o disparo dos emails**
- Basta fazer o cadastro de um Livro que será disparado e podera ser visto no mailtip que está rodando local
