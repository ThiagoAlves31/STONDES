### STONDES
----
Pré-requisitos:
- [Git](https://git-scm.com/ "Git")
- [Composer](https://getcomposer.org/ "Composer")
- [Docker](https://docs.docker.com/get-started/ "Docker")
- [Docker Compose](https://docs.docker.com/compose/install/ "Docker Compose")

#### Para iniciar o projeto siga os passos abaixo:
```
git clone https://github.com/ThiagoAlves31/STONDES.git
```
```
cd STONES
```
```
cp .env-example .env
```
```
sudo apt-get install php7.2-mbstring && sudo apt-get install php7.2-xml
```

```
composer install
```
#### Agora vamos iniciar o container:

Por default a porta padrão do Mysql é a 3306 e do Nginx 8080.

Essa configuração pode ser alterada no docker-compose.yml na raiz do projeto.
```
docker-compose up -d 
```
#### Após iniciar o container vamos acessá-lo para algumas configurações:
```
docker exec -it  stones-docker-php-fpm bash
```
#### A partir de agora já estamos dentro do container.
Vamos adicionar permissão nos Logs, por ser ambiente de teste vai ser 777 mesmo.
```
chmod -R 777 storage/*
```
Criar tabelas e adicionar dados fictícios.
```
php artisan key:generate
php artisan migrate
php artisan db:seed
```
Pronto, já estamos com o ambiente funcionando
Basta apenas acessar http://localhost:8080

### Utilizando API
#### Produtos
- GET  /api/products        - Lista todos os produtos
- GET  /api/products/{id}   - Lista um produto pelo id
- POST /api/products        - Cria um novo produto passando um Json. (Tipo somente Livro ou CD)
```
{
    "type": "CD",
    "name": "Red Hot",
    "description": "Californication"
}
```
- PUT /api/products/{id}    - Atualiza um produto passando um id e Json.Podendo atualizar 1 ou mais ítens do produto
```
{
    "name": "PHP - 2019",
    "description": "Atualizando descrição"
}
```
- DELETE /api/products/{id} - Deleta um produto pelo id

#### Contatos
- GET  /api/contacts        - Lista todos os contatos
- GET  /api/contacts/{id}   - Lista um contato pelo id
- POST /api/contacts        - Cria um novo contato passando um Json.
```
{
    "contact_name": "José",
    "contact_phone": "21-2222-2222",
    "contact_email": "jose@jose.com"
}
```
- PUT /api/contacts/{id}    - Atualiza um contato passando um id e Json.Podendo atualizar 1 ou mais ítens do contato
```
{
    "contact_phone": "21-3333-2222",
}
```
- DELETE /api/contacts/{id} - Deleta um contato pelo id

#### Empréstimos
- GET  /api/lents           - Lista todos os empréstimos do momento
- GET  /api/lents/{id}      - Lista um empréstimo pelo id
- POST /api/lents           - Cria um novo empréstimo passando um Json.
```
{
    "contact_id": 5,
    "product_id": 2,
}
```
- PUT /api/lents/{id}    - Desfaz um empréstimo passando um id.
