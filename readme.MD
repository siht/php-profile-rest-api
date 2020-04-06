# BASIC REST API

This is a basic rest api, that insert profiles with title and image

## requirements

- php:7.4.3
- apache with mod rewrite enable
- mariadb:5.5.60
- curl
- composer

## environment variables

- "CONNECTION_STRING"
- "IMGUR_CLIENT_ID"
- "IMGUR_URL"

these variable goes in this form

```text
CONNECTION_STRING=mysql://your_user:password@host/database
IMGUR_CLIENT_ID=an_id
IMGUR_URL=https://api.imgur.com/3/image
```

if you dont want set these variables modify the .env file and put these variable there.

## how to install

Once requirements are satisfied and environment vars was setted, place this project in apache pointing project root.

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

- get /profiles -> list all profiles
- post /profile/new -> insert new profile
- post /profile/{id}/upload-image -> upload image to imgur and update profile

## how to insert data

The / in post method require a json object with the next format

```json
'{"nombre": "some string", "titulo": "some string", "image": "a string that point to url image"}'
```

try with curl

```sh
curl -H "Content-Type: application/json" -X POST --data '{"titulo": "titulo", "image": "imagen", "nombre": "nombre"}' http://your-host:your-port/profile/new
```

## TODO

- cover when exists a database
- add 400 error for routes that doesn't exist yet
- whatever
