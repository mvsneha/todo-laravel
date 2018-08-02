# Simple Todo Application using Laravel with user authentication

## Build Setup for running in local
#### Setup 

``` bash
# Install dependencies

    composer update

#Copy .env.example to .env

# Create a database and update the details in .env

    DB_CONNECTION=mysql
    DB_HOST=localhost
    DB_PORT=3306
    DB_DATABASE=mytodos
    DB_USERNAME=xxxx
    DB_PASSWORD=xxx

# Run the following php command

php artisan key:generate

php artisan migrate

# Run development version

php artisan serve


```
