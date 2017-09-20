# Posts API

Uma API simples, sem o uso de Frameworks para o acesso e gerenciamento de posts

## instalando

Primeiro clone o repositorio
```
$ git clone https://github.com/aafreire/post-api.git
```
Inicie o container
```
$ docker-compose up -d
```
### composer

Conecte na maquina do docker e atualize as dependencias
```
$ docker exec -it post-api bash
$ cd /var/www/html
$ composer install
```

### Migrations

Conectado na maquina do Docker e na pasta do projeto
```
$ vendor/bin/phinx migration
```

### Hosts
