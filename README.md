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
$ vendor/bin/phinx migrate
```

## Utilizando a Api
Para usar os recursos da api é necessario se autenticar primeiro, enviando uma requisição POST para http://postapi.dev/login com o seguinte json:
```
{
	"username": "johndoe",
	"password": "somepass"
}
```
No momento, não existem outros usuários cadastrados na plataforma, nem a possibilidade de efetuar um novo cadastro

A resposta dessa requisição parecida com essa:
```
{
    "data": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJub25lIn0.eyJpc3MiOiJQb3N0IEFQSSIsImF1ZCI6IlBvc3QgQVBJIiwiaWF0IjoxNTA1OTY0NzI2LCJleHAiOjE1MDU5NjgzMjZ9."
    }
}
```

para as próximas requisições será necessario enviar esse token no header "Authorization"

### Criando um post
Para criar um post envie uma requisição POST para http://postapi.dev/post, e preencha os dados do seu post no corpo da requisição, conforme o exemplo abaixo:
```
{
	"title": "meu post",
	"body": "texto do meu post",
	"path": "/link/para/post"
}
```

você receberá uma resposta parecida com essa
```
{
    "data": {
        "id": 13,
        "title": "meu post",
        "body": "texto do meu post",
        "path": "/link/para/post"
    }
}
```

### editando um post
Para editar um POST, o modelo da requisição é igual ao anterior, mas utilizando o metódo PUT e inserindo o id do seu post na url ex:(http://postapi.dev/post/13)

### recuperando um post por id
Para recuperar um único post, envie uma requisição GET para http://postapi.dev/post/{id_do_post}

### recuperando todos os posts
Para recuperar todos os posts, envie uma requisição GET para http://postapi.dev/post a resposta da requisição será parecida com essa:
```
{
    "data": [
        {
            "id": 12,
            "title": "some title",
            "body": "some body",
            "path": "/teste/path"
        },
        {
            "id": 13,
            "title": "meu post",
            "body": "texto do meu post",
            "path": "/link/para/post"
        }
    ]
}
```

### recuperando um post pelo path
Para recuperar um post pelo path, envie uma requisição GET para http://postapi.dev{path_do_post} ex:(http://postapi.dev/link/para/post)
