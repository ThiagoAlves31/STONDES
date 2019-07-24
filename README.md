### STONDES

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
