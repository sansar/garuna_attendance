# deployment guide

Clone the repository

    git clone https://github.com/sansar/garuna_attendance

Switch to the repo folder

    cd garuna_attendance

1.composer install  
1.php artisan migrate  
2.php artisan db:seed  
3.expose public folder on nginx or apache config

# Config following on .env settings

APP_NAME=attendance  
APP_ENV=local  
APP_KEY=base64:vIfD9wve8tBHQdHPCYGfKBfFSAqj792tInTTrf7xl7I=  
APP_DEBUG=true  
APP_URL=http://localhost

LOG_CHANNEL=stack  
LOG_DEPRECATIONS_CHANNEL=null  
LOG_LEVEL=debug

DB_CONNECTION=mysql  
DB_HOST=127.0.0.1  
DB_PORT=3306  
DB_DATABASE=attendance  
DB_USERNAME=root  
DB_PASSWORD=

BROADCAST_DRIVER=log  
CACHE_DRIVER=file  
FILESYSTEM_DISK=local  
QUEUE_CONNECTION=sync  
SESSION_DRIVER=file  
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1  
REDIS_PASSWORD=null  
REDIS_PORT=6379

MAIL_MAILER=smtp  
MAIL_HOST=smtp.gmail.com  
MAIL_PORT=465  
mail_username=garuna.publish@gmail.com  
MAIL_PASSWORD="cplk fvyp dmqi cnai"  
MAIL_ENCRYPTION=tls  
mail_from_address=garunapublishing@gmail.com  
MAIL_FROM_NAME="${APP_NAME}"

# admin password

username: sansar  
password: 123  


