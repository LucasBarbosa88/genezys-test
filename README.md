## Commands to run project

composer install

Create a copi of .env.example: cp .env.example .env

To create the tables run the following command:
php artisan migrate

Run the project with follow command:
php artisan serve

If you are using insomnia to test the endpoints, there is a file called Insomnia_2022-12-13.json where you can import all.

## Endpoints to test

http://localhost:8000/api/auth/register
http://localhost:8000/api/login
http://localhost:8000/api/auth/logout
http://localhost:8000/api/get-cep
http://localhost:8000/api/auth/users
http://localhost:8000/api/password
http://localhost:8000/api/recovery-password
