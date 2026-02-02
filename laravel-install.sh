docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd)/src:/var/www/html" \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer create-project laravel/laravel .
