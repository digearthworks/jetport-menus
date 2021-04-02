
# well-begun-is-half-done

### We have a Badge!

[![Tests](https://github.com/digearthworks/well-begun-is-half-done/workflows/Tests/badge.svg?branch=main)](https://github.com/digearthworks/well-begun-is-half-done/workflows/Tests/)

### Getting started

```
git clone https://github.com/digearthworks/well-begun-is-half-done.git
```

```
cd well-begun-is-half-done
```

```
cp .env.example .env
```

```
edit .env
```

```diff

- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=dev_menus
- DB_USERNAME=root
- DB_PASSWORD=

+ DB_CONNECTION=your_connection
+ DB_HOST=your_host
+ DB_PORT=your_port
+ DB_DATABASE=your_database
+ DB_USERNAME=your_username
+ DB_PASSWORD=your_password
```

>local (Requires php ^7.3|^8.0)

### Dependencies:

```
composer install
```
### Assets:

```
npm install && npm run dev
```

#### Or: 

```
yarn && yarn run dev
```

### Migrate:

```
php artisan migrate --seed
```

### Serve

```
php artisan serve
```




> Sail (Requires Docker and Docker Compose)
```
./vendor/bin/sail up
```

### Test

```
php artisan test
```
> Sail
```
./vendor/bin/sail artisan test
```

### Links

- https://laravel.com/docs/8.x/sail
- https://jetstream.laravel.com/2.x/introduction.html
- https://laravel.com/docs/8.x/passport
- https://github.com/laravel/passport/pull/1352
- https://github.com/laravel/passport/tree/4e53f1b237a9e51ac10f0b30c6ebedd68f6848ab/resources
