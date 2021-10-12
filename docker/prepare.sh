#!/bin/sh

cd /var/prog/szkola

echo 'DATABASE_URL="mysql://szkola:bbbb@database:3306/szkola?serverVersion=10.5"' >.env.local

ls -la
pwd

echo "czekam na DB"

./wait-for-it.sh database:3306 -t 60

php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load -q

/root/.symfony/bin/symfony serve
