# Support and Acknowledgements

This project is heavily based on @rappasoft 's [laravel/boilerplate](https://github.com/rappasoft/laravel-boilerplate)

If you wish to support a project please support him, or one of this project's dependencies, such as [spatie](https://github.com/spatie/laravel-permission) or [calebporzio](https://github.com/livewire/livewire), to name a couple.

# Road Map

### Alpha. *Menus*

- [x] OAuth2 Server
- [x] Permissions Role User with Livewire Datatable Frontend.
- [x] Admin Impersonation of Users
- [x] Menu Management Crud
- [x] Assignable Menus for Each User
- [ ] Alpha Docs

### Beta. *Jetport*
- [ ] Must first complete Alpha Checklist
- [ ] Implement openapi documentation for OAuth server with swagger frontend.
- [ ] Restful API for key resources.
- [ ] Documentation Guidelines, and support libraries for extending API
- [ ] Build a Service or Client library for consuming API
- [ ] Documented Guidelines and Support Libraries for extending Client

### RC. *Going Silver*
- [ ] Must first complete Beta Checklist
- [ ] Ability to share and consume "*key resourses*" to and from instances
- [ ] Implement SSO with an open source email client
- [ ] Implement ability to manage auth for Nexcloud server (Supports OAuth2)  


### Release. *Prod 1*
- [ ] Must first complete RC Checklist
- [ ] Deployment Pipelines
- [ ] Openid connect 

### Perpetual Beta. *Rolling Release*

- Perfect Documentation, tutorials, and internal wikis
- Maintain, Implement and Test inflow of new features
- Build and implement in-house, in-app, integrated bug reporter





----
[![Tests](https://github.com/digearthworks/jetport-menus/workflows/Tests/badge.svg?branch=main)](https://github.com/digearthworks/jetport-menus/actions/workflows/main.yml)
----

 - [Laravel Jetstream](https://jetstream.laravel.com/2.x/introduction.html) with [Livewire](https://github.com/livewire/livewire)
 - Full Featured [Laravel Passport](https://github.com/laravel/passport) api in place of of [Laravel Sanctum](https://github.com/laravel/sanctum)
 - A full OAuth2 server, complete with [Tailwind](https://tailwindcss.com/) Styled Client and Token Management UI in minutes!

![api-tokens](https://user-images.githubusercontent.com/47095624/118184596-89878f00-b409-11eb-84b9-dc61b7e5e5a6.png)

### Development Demo 

https://jetport.turbooffice.net

**email** `admin@admin.com` **password** `secret`

### Dev Deploy Script
```bash
cd /home/forge/jetport.turbooffice.net

if [ -f artisan ]; then
    php artisan down
fi

if [ -d ./vendor ]; then
    rm -rf ./vendor
fi

BRANCH=development 

git fetch --all; git reset --hard origin/$BRANCH; git pull origin $BRANCH ; 

$FORGE_COMPOSER install --no-interaction --prefer-dist --optimize-autoloader

( flock -w 10 9 || exit 1
    echo 'Restarting FPM...'; sudo -S service $FORGE_PHP_FPM reload ) 9>/tmp/fpmlock

if [ -f artisan ]; then
   # $FORGE_PHP artisan migrate:refresh --seed
   # $FORGE_PHP artisan up
   ./vendor/bin/envoy run dev
   php artisan up
fi
```

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
#### Mac or Linux
```
./vendor/bin/envoy run dev
```

#### You may optionally pass test flag

```
./vendor/bin/envoy run dev --test
```
#### Windows

See https://laravel.com/docs/8.x/installation#getting-started-on-windows

Or follow steps in `dev` task in Envoy.blade.php:

```blade
@task('dev', ['on'=> 'localhost'])
    php artisan key:generate
    npm install && npm run dev
    php artisan storage:link
    php artisan passport:keys
    php artisan db:wipe
    php artisan migrate:refresh --seed
    {{ isset($test) ? 'php artisan test' : '' }}
@endtask
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

### Reference
- https://laravel.com/docs/8.x/envoy
- https://laravel.com/docs/8.x/sail
- https://jetstream.laravel.com/2.x/introduction.html
- https://laravel.com/docs/8.x/passport
- https://github.com/laravel/passport/pull/1352
- https://github.com/laravel/passport/tree/4e53f1b237a9e51ac10f0b30c6ebedd68f6848ab/resources




