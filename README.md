# Thoth API

Web development trends & news

![CI](https://github.com/sturquier/thoth-api/workflows/CI/badge.svg?branch=master) [![codecov](https://codecov.io/gh/sturquier/thoth-api/branch/master/graph/badge.svg)](https://codecov.io/gh/sturquier/thoth-api)

## Run project

* Clone repository `git clone https://github.com/sturquier/thoth-api`
* Go to root directory `cd thoth-api`
* Install dependencies `composer install`
* Edit DB configuration in .env.local file. For example `DATABASE_URL=mysql://root:root@127.0.0.1:3306/thoth_db`
* Create DB `php bin/console doctrine:database:create`
* Run migrations `php bin/console doctrine:migrations:migrate`
* Load fixtures `php bin/console doctrine:fixtures:load`
* Run server `php bin/console server:run`
