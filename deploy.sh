
php app/console cache:clear
php app/console cache:clear --env=prod --no-debug

chown www-data:www-data -R app/cache
chown www-data:www-data -R app/logs

pph app/console assets:install web --symlink

php app/console assetic:dump
php app/console assetic:dump --env=prod --no-debug

chmod 777 -R app/cache
chmod 777 -R app/logs