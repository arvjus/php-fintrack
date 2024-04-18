## Fintrack - Personal Financial Tracking Software

Powered by [Laravel 4 Framework](http://github.com/laravel/framework)


### License

The MIT License (MIT)

Copyright © 2014 Arvid Juskaitis <arvydas.juskaitis@gmail.com>


### Some of screenshots

Click to view.

[![List expenses](https://raw.githubusercontent.com/arvjus/php-fintrack/master/screenshots/list-expenses-thumb.png)](https://raw.githubusercontent.com/arvjus/php-fintrack/master/screenshots/list-expenses.png)

[![Show summary](https://raw.githubusercontent.com/arvjus/php-fintrack/master/screenshots/summary-thumb.png)](https://raw.githubusercontent.com/arvjus/php-fintrack/master/screenshots/summary.png)

[![Add new income](https://raw.githubusercontent.com/arvjus/php-fintrack/master/screenshots/add-income-thumb.png)](https://raw.githubusercontent.com/arvjus/php-fintrack/master/screenshots/add-income.png)

[![Add new expense](https://raw.githubusercontent.com/arvjus/php-fintrack/master/screenshots/add-expense-thumb.png)](https://raw.githubusercontent.com/arvjus/php-fintrack/master/screenshots/add-expense.png)


### Prerequisites

* PHP >= 5.4
* PHP modules - openssl.so, mcrypt.so, mysqli.so, pdo_mysql.so
* [Composer](https://getcomposer.org)
* MySQL 5.x
* Apache 2 Web Server (optional)

## Install mcrypt on macosx

brew search mcrypt
brew tap homebrew/dupes
josegonzalez/homebrew-php
brew install php54-mcrypt
sudo cp /usr/local/Cellar/php54-mcrypt/5.4.45/mcrypt.so /usr/lib/php/extensions/no-debug-non-zts-20100525/


### Installation

Clone repository, install components
```bash
$ git clone https://github.com/arvjus/fintrack
$ cd fintrack
$ composer.phar install
```

Install database, configure in app/config/database.php

Migrate database, seed test data
```bash
$ php artisan migrate:make
$ php artisan migrate:refresh
$ php artisan db:seed
```

Optionally, run unitests
```bash
$ phpunit
```


Start built-in web server
```bash
$ php artisan serve
```

Go to [http://localhost:8000](http://localhost:8000) and login with admin/admin123


### Run on MacOSX /Library/Fintrack

run misc/install-on-mac.sh from project root

sudo launchctl load -w /Library/LaunchDaemons/org.zv.fintrack.plist
sudo launchctl unload -w /Library/LaunchDaemons/org.zv.fintrack.plist


### Build Docker image, run

docker build -t arvjus/fintrack:1.0.1 .
docker run -d -p 8082:8082 arvjus/fintrack:1.0.1


### Changelog

2018-01-17 Dockerize application 1.0.1
2014-05-17 Release Version 1.0


