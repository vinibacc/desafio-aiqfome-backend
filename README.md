#  Desafio aiqfome Backend

---

## Tecnologias Utilizadas

- [Laravel](https://laravel.com/)
- [Docker](https://www.docker.com/)
- [PHP](https://www.php.net/)
- [PostgreSQL](https://www.postgresql.org/)
- [Swagger](https://swagger.io/) via [l5-swagger](https://github.com/DarkaOnLine/L5-Swagger)

---

## Por que escolhi essas ferramentas

### Ferramentas que eu gosto (e conheço bem)

Usei **Laravel** porque é um framework que eu já tenho bastante experiência, então consigo desenvolver rápido e com organização. Além disso, ele já vem com muita coisa pronta (autenticação, rotas, migrations...), o que agiliza demais.

Pra rodar tudo, fui de **Docker**. Gosto de usar porque facilita a vida de quem vai testar o projeto — é só subir os containers e tá tudo funcionando. E como já estou bem familiarizado com Docker, montar o ambiente foi tranquilo.

O banco de dados é **PostgreSQL**, que também é uma escolha que faço com frequência. Gosto da estabilidade e dos recursos que ele oferece, e como já trabalhei bastante com ele, me sinto à vontade.

#### Autenticação e testes

Implementei autenticação com **JWT**, que é uma solução simples e eficiente pra proteger as rotas. Dá pra testar tudo direto pela interface interativa com **swagger** — tem exemplos prontos e é só clicar em **“Try it Out”**.

---

## Pré-requisitos

Antes de iniciar, certifique-se de ter instalado:

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [Git](https://git-scm.com/)

---

## Como Rodar o Projeto

Siga os passos abaixo para subir o ambiente local:

### 1. Clone o repositório

```bash
git clone https://github.com/vinibacc/desafio-aiqfome-backend.git
cd desafio-aiqfome-backend
```
### 2. Subindo os containers com Docker

```bash
docker compose up --build -d
```
### 3. Gerando a chave do projeto

```bash
docker exec -it desafio_aiqfome_app php artisan key:generate
```
### 4. Rodando as migrations

```bash
docker exec -it desafio_aiqfome_app php artisan migrate
```

## Documentação da API - Desafio aiqfome Backend

A API foi desenvolvida em PHP com framework Laravel como parte do desafio técnico da aiqfome. A documentação é gerada automaticamente com **Swagger** via a biblioteca `l5-swagger`.

---

###  Base URL

http://localhost:8000/api/documentation

> A documentação é gerada automaticamente com base nas anotações dos controllers e rotas.


### Autenticação

A API utiliza autenticação via **Bearer Token**.

### Cabeçalho de Autenticação

```http
Authorization: Bearer {seu_token}
```

## Testando as rotas da API

Em cada rota da API, você encontrará o botão **Try it Out**, que permite testar as requisições diretamente pela interface.

### Criando um usuário

Na rota **Auth → Register**, já existe um exemplo válido preenchido. Basta clicar em **Execute** para criar um novo usuário.

Após a execução, a resposta incluirá um **token de autenticação**. Copie esse token e guarde com atenção — ele será necessário para acessar rotas protegidas.

### Autenticando com o token

Para utilizar o token nas demais rotas:

1. Clique no botão verde **Authorize** no canto superior direito da interface (ícone de cadeado).
2. Cole o token no campo apropriado.
3. Confirme a autorização.

Com isso, suas requisições passarão a ser autenticadas corretamente.

---

**Obrigado pela oportunidade!**
 
**Espero que gostem do que foi desenvolvido!**

## Contato
[LinkedIn](https://www.linkedin.com/in/vinicius-ugoski-bacchieri)

vbacch@gmail.com

