# HN-Scraper (or rather from the [official api](https://github.com/HackerNews/API))

[Test instance](https://hn.mikusr.info)

Application for getting stories from HN and displaying them in a [datatable](https://datatables.net/) as a Vue 3
component.

![](images/main.png "Main screen of application")

## changes

2025-04-06 updated PHP to 8.2, Laravel to 12

## todo

migrate to Laravel 11 slimmer structure

## Requirements

- PHP 8.2
- MySQL (tested on 8.0.35) or SQLite
- Node.js 20

## Install

currently supports running on coolify with sqlite

1. add application
2. git url <https://github.com/MikusR/hn-scraper.git>
3. nixpacks as Build Pack
4. add peristent storage volume mounted, for example, /app/persistent-db
5. add environment variables

```conf
APP_DEBUG=false
APP_ENV=production
APP_KEY=63c9b80ac2085916364e2e9340423d8f
APP_URL=https://[YOUR_URL]
DB_CONNECTION=sqlite
DB_DATABASE=/app/persistent-db/database.sqlite
```

6. add scheduled task recommended (\* \* \* \* \*)

```bash
php artisan schedule:run
```

7. fix permissions

```bash
touch persistent-db/database.sqlite
php artisan migrate
chmod 777 persistent-db
chown "www-data":"www-data" persistent-db/database.sqlite
```

## Commands

App comes with different ways to get data

for example

```bash
php artisan scrape:fromapi
```

uses official HN api to get links

command by default fetches `best` stories. There are also `new` and `top` to be used like this

```bash
php artisan scrape:fromapi new
```

Default schedule gets `new` stories every hour and `best` and `top` every couple hours
