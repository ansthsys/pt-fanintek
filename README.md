# Test Code RESTful API

RESTful API Documentation: [here](https://documenter.getpostman.com/view/20118417/2s93z6djFG)

Installation Guide:
1.    Clone repo ```https://github.com/ansthsys/pt-fanintek```
2.    Change directory into project ```cd pt-fanintek```
3.    Switch to branch ```test-script```
4.    Install dependecies from Composer ```composer install```
5.    Install dependecies from NPM ```npm install```
6.    Create .env file ```cp .env.example .env```
7.    Create application encryption key ```php artisan key:generate```
8.    Setup database using PostgreSQL in ```.env```
      ```
      DB_CONNECTION=pgsql
      DB_HOST=127.0.0.1
      DB_PORT=5432
      DB_DATABASE="Database Name"
      DB_USERNAME="Database Username"
      DB_PASSWORD="Database Password"
      ```
9.    Run migrations and seeders ```php artisan migrate --seed```
10.    Run Application ```php artisan serve```
