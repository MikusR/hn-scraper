# install

clone repository

```bash
git clone https://github.com/MikusR/hn-scraper.git
```

use Composer to get dependencies

```bash
composer install
```

generate Laravel app key

```bash
php artisan key:generate
```

use npm to get dependencies for Vue

```bash
npm install
```

build assets

```bash
npm run production
```

copy .env.example to .env
and configure access to database
for example:

```ini
DB_CONNECTION = sqlite
DB_HOST = 127.0.0.1
DB_PORT = 3306
```

If using sqlite

```bash
touch database/database.sqlite
```

Run artisan migrate to create database tables

```bash
php artisan migrate
```

run

```bash
php artisan serve
```

add cron job to run schedule

```bash
crontab -e
```

```cronexp
* * * * * cd {your path} && php artisan schedule:run >> /dev/null 2>&1
```
