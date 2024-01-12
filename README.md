## ENV
````
AUTH_TOKEN=wx5xq6z3vqp37cqmiescgjjzxbc3
LINK_LENGTH=6
LINK_NOT_FOUND=https://google.com
LINK_HOME_REDIRECT=https://google.com
LINK_FAILED=https://google.com
````

## ENV TESTING

````
DB_CONNECTION=sqlite
DB_DATABASE=:memory:
DB_FOREIGN_KEYS=false

AUTH_TOKEN=wx5xq6z3vqp37cqmiescgjjzxbc3
LINK_LENGTH=6
LINK_NOT_FOUND=https://google.com
LINK_HOME_REDIRECT=https://google.com
LINK_FAILED=https://google.com
````
````
composer install
php artisan sail:install (Select MySQL)
sail artisan optimize
sail artisan migrate
````

````
Route: 

POST api/shorter (url => 'google.com')
GET /{hash}
````
