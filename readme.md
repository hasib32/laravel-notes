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
In order to use the API we need to create an access_token. Make a POST request to `oauth/token` endpoint. Requied fields are: ` grant_type, client_id, client_secret, username, password`. Don't get confuse with the `username` fields. You have to use users table `email` column value as username and you can use `secret` as password. For testing purpose we can use Postman for creating access_token. Here is a screenshot for creating access_token using Postman


![access_token creation](/public/images/notes-app-access-token.png?raw=true "access_token creation example")


We can use the newly created access_token to make API call. Here are the avilable API resources:

| HTTP Method	| Path | Action | Desciption  |
| ----- | ----- | ----- | ------------- |
| GET      | api/users | index | Get all users
| POST     | api/user | store | Create an user. Required fields: `email, firstName, lastName, password`
| GET      | api/users/{user_id} | show |  Fetch an user by id
| PUT      | api/users/{user_id} | update | Update an user by id
| DELETE   | api/users/{user_id} | destroy | Delete an user by id
| GET      | api/notes | index | Get all notes
| POST     | api/notes | store | Create a note. Available fields: `message, tags`
| GET      | api/notes/{note_id} | show |  Fetch a note by id
| PUT      | api/notes/{note_id} | update | Update a note by id
| DELETE   | api/notes/{note_id} | destroy | Delete a note by id

## Running phpunit tests
Run this command from the projcet root directory.
```bash
$ vendor/bin/phpunit
```
