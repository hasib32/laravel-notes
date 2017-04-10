# A Laravel 5.4 RESTful API for creating notes.

## Getting Started
First, clone the repo:
```bash
$ git clone git@github.com:hasib32/laravel-notes.git
```
#### Dev server with Laravel Homestaed
You can use Laravel Homestead for local development or to see a live demo of the API. Follow the Follow the [Installation Guide]
(https://laravel.com/docs/5.4/homestead#installation-and-setup).

#### Install dependencies
```
$ cd laravel-notes
$ composer install
```

#### Configure the Environment
Create `.env` file:
```
$ cat .env.example > .env
```
#### Create and Seed database

First, we need connect to the database. For homestead user, login using default homestead username and password:
```bash
$ mysql -uhomestead -psecret
```

Then create a database:
```bash
mysql> CREATE DATABASE notesapi;
```

And also create test database:
```bash
mysql> CREATE DATABASE notesapi_test;
```

Run the Artisan migrate command with seed:
```bash
$ php artisan migrate --seed
```

Create "personal access" and "password grant" clients which will be used to generate access tokens:
```bash
$ php artisan passport:install
```
You can find those clients in "oauth_clients" table.

## Testing API with [Postman.](https://www.getpostman.com/)
In order to use the API first we need to create a access_token. For testing purpose we can use Postman for creating access_token.

Then, we can use that access_token to make API call. Here are the avilable API resources:

| HTTP Method	| Path | Action | Desciption  |
| ----- | ----- | ----- | ------------- |
| GET      | api/users | index | Get all users
| POST     | api/user | store | Create an user. Required fields: email, firstName, lastName
| GET      | api/users/{user_id} | show |  Fetch an user by id
| PUT      | api/users/{user_id} | update | Update an user by id
| DELETE   | api/users/{user_id} | destroy | Delete an user by id
| GET      | api/notes | index | Get all notes
| POST     | api/notes | store | Create a note. Reqired fields: 
| GET      | api/notes/{note_id} | show |  Fetch a note by id
| PUT      | api/notes/{note_id} | update | Update a note by id
| DELETE   | api/notes/{note_id} | destroy | Delete a note by id
