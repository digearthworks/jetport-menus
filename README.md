

# Laravel Jetport

 - [Laravel Jetstream](https://jetstream.laravel.com/2.x/introduction.html) with [Livewire](https://github.com/livewire/livewire)
 - Full Featured [Laravel Passport](https://github.com/laravel/passport) api in place of of [Laravel Sanctum](https://github.com/laravel/sanctum)
 - A full OAuth2 server, complete with [Tailwind](https://tailwindcss.com/) Styled Client and Token Management UI in minutes!

[![Tests](https://github.com/digearthworks/jetport-menus/workflows/Tests/badge.svg?branch=main)](https://github.com/digearthworks/jetport-menus/actions/workflows/main.yml)


**email** `admin@admin.com` **password** `secret`

### Getting started

```
git clone https://github.com/digearthworks/jetport-menus
```

```
cd jetport-menus
```
```
composer install
```

```
edit .env
```

```
./vendor/bin/envoy run dev
```

#### You may optionally pass test flag

```
./vendor/bin/envoy run dev --test
```

### default login

**email** `admin@admin.com`
**password** `secret`

### Testing

```
composer test
```

### Contributing

```
composer format
```
[Contributing](https://github.com/digearthworks/laravel-jetport/blob/main/.github/CONTRIBUTING.md)

### Useful Links
- https://laravel.com/docs/8.x/envoy
- https://laravel.com/docs/8.x/sail
- https://jetstream.laravel.com/2.x/introduction.html
- https://laravel.com/docs/8.x/passport
- https://github.com/laravel/passport/pull/1352
- https://github.com/laravel/passport/tree/4e53f1b237a9e51ac10f0b30c6ebedd68f6848ab/resources
