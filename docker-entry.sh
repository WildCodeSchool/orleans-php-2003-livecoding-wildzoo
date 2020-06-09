#!/bin/sh

#### SYMFONY
## If you are versionning migrations classes
#php bin/console doctrine:migrations:migrate  --verbose --no-interaction --allow-no-migration
## If you want to hard update your SQL DB
php bin/console doctrine:schema:update --force
php bin/console doctrine:fixtures:load --no-interaction
##### you can use both in fact, if you don't trust your students

php-fpm &
nginx -g "daemon off;"
