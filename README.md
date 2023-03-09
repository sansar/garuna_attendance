# deployment guide

Clone the repository

    git clone https://github.com/sansar/garuna_attendance

Switch to the repo folder

    cd garuna_attendance

1.composer install
1.php artisan migrate
2.php artisan db:seed
3.expose public folder on nginx or apache config
