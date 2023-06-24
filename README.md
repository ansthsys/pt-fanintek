# Test Code RESTful API

RESTful API Documentation: [here](https://documenter.getpostman.com/view/20118417/2s93z6djFG)

Installation Guide:
1.    Clone repo ```https://github.com/ansthsys/pt-fanintek```
2.    Switch to branch ```test-script```
3.    Install dependecies from Composer ```composer install```
5.    Setup database using PostgreSQL in ```.env```
      ```
      DB_CONNECTION=pgsql
      DB_HOST=127.0.0.1
      DB_PORT=5432
      DB_DATABASE="Database Name"
      DB_USERNAME="Database Username"
      DB_PASSWORD="Database Password"
      ```
7.    Run migrations and seeders ```php artisan migrate --seed```
8.    Run Application ```php artisan serve```
