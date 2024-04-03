# HN-Scraper (or rather from the [official api](https://github.com/HackerNews/API))

Application for getting stories from HN and displaying them in a [datatable](https://datatables.net/) as a Vue 3
component.

![](images/main.png "Main screen of application")

## Requirements

- PHP 7.4
- MySQL (tested on 8.0.35) or SQLite

## Install

clone repository

```bash
$ git clone https://github.com/MikusR/hn-scraper.git
```

use Composer to get dependencies

```bash
$ composer install
```

use npm to get dependencies for Vue

```bash
$ npm install
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

Run artisan migrate to database tables

```bash
php artisan migrate
```

run

```bash
php artisan serve
```

