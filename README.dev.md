
composer require tymon/jwt-auth --ignore-platform-req=ext-ftp
&&
composer require tymon/jwt-auth

php artisan vendor:publish --tag=laravel-assets --ansi --force