# BASIC REST API

This is a basic rest api, that insert profiles with title and image

## requirements

- php:7.4.3
- apache with mod rewrite enable
- mariadb:5.5.60
- composer

## environment variables

"CONNECTION_STRING" this variable goes in this form

```text
CONNECTION_STRING=mysql://your_user:password@host/database
```

if you dont want set this variable modify the .env file and put these variable there.

## how to install

Once requirements are satisfied and environment vars was setted, place this project in apache and configure to point public folder.

Setup your database with an user and a database attached to your user (recommended).

After locate in the root of this project and run in shell

```sh
composer install
```

after all dependencies was installed run.

```sh
vendor/bin/doctrine orm:schema-tool:create
```

## routes

The main route is / (root)

- get method -> list all profiles
- post method -> insert new profile

## how to insert data

The / in post method require a json object with the next format

```json
'{"title": "some string", "image": "a string that point to url image"}'
```

try with curl

```sh
curl -H "Content-Type: application/json" -X POST --data '{"title": "titulo", "image": "imagen"}' http://your-host:your-port
```

## TODO

- cover when exists a database
- add 400 error for routes that doesn't exist yet
- whatever
