# Laravel simple chat messenger

This is a simple chat messenger build with laravel and pusher.

# Installation

1. Clone the project
2. Run `composer install` command
3. set configurations into `.env` file:

- set database configs

set pusher configs:

```bash
#...
BROADCAST_DRIVER=pusher
#...
PUSHER_APP_ID=1738360
PUSHER_APP_KEY=d98ff60c75de6dc30854
PUSHER_APP_SECRET=f71b67d9ac1b42f5226b
#...
PUSHER_APP_CLUSTER=eu
#...
```

4. generate key: `php artisan key:generate`
5. migrate database: `php artisan migrate`
6. Run the project `php -S localhost:9099 -t public`
7. First, register, then login :)
