
# How to run deploy script:
# ./deploy.sh & ./npm.sh

#git stash
git pull --force

php app/console doctrine:schema:update --force --dump-sql

# Run composer with unlimited memory limit
# php -d memory_limit=-1 composer.phar update

php composer.phar self-update
php composer.phar update
php composer.phar dump-autoload --optimize

php app/console cache:clear
php app/console cache:clear --env=prod --no-debug

chown www-data:www-data -R app/cache
chown www-data:www-data -R app/logs

php app/console assets:install web --symlink

#php app/console assetic:dump
#php app/console assetic:dump --env=prod --no-debug

chmod 777 -R app/cache
chmod 777 -R app/logs