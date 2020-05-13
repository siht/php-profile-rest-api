# BASIC REST API

This is a basic rest api, that insert profiles with title and image see his functionality in [this page](https://peaceful-waters-33097.herokuapp.com/profiles) because this is a hobist project in heroku maybe needs a refresh in some configurations, ask for me to refresh conf and you can see the results.

## requirements

- php:7.4.3
- apache with mod rewrite enable
- mariadb:5.5.60 (I tested with this locally, but you can use other. See [doctrine documentation](https://www.doctrine-project.org/projects/doctrine-dbal/en/2.10/reference/configuration.html#connecting-using-a-url))
- curl
- composer

## environment variables

- "CONNECTION_STRING"
- "IMGUR_CLIENT_ID"
- "IMGUR_URL"
- "ACCEPTED_SITES"

these variable goes in this form

```text
CONNECTION_STRING=mysql://your_user:password@host/database
IMGUR_CLIENT_ID=an_id
IMGUR_URL=https://api.imgur.com/3/image
ACCEPTED_SITES=*
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

for test image upload

```sh
curl -X POST -H "Content-Type: multipart/form-data" -F "image=@/path/to/your/image.jpg" http://your-host:your-port/profile/{object_id}/upload-image
```

## TODO

- cover when exists a database
- add 400 error for routes that doesn't exist yet
- whatever
