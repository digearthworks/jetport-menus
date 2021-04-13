# Road Map


### First Steps
- [ ] Improve This List
- [ ] Improve this README
- [ ] Create Detailed issues for each item on Alpha list
* Put a link to the issue next to each item
* Include Screenshots and Gifs of examples when available
* Incude code snippents from and links to examples when available
* Reference [Boilerplate](https://github.com/digearthworks/laravel-ui-boilerplate) when applicable
      
- [ ] Begin Documentation 

### Alpha. *Menus*

- [x] OAuth2 Server
- [ ] Permissions Role User with Livewire Datatable Frontend.
- [ ] Admin Impersonation of Users
- [ ] Menu Management Crud
- [ ] Assignable Menus for Each User
- [ ] Alpha Docs

### Beta. *Jetport*
- [ ] Must first complete Alpha Checklist
- [ ] Implement openapi documentation for OAuth server with swagger frontend.
- [ ] Restful API for key resources.
- [ ] Create Docmentation Guidlines, and support libraries for extending API
- [ ] Build a Service or Client library for consuming API
- [ ] Create Docmentated Guidlines and Support Libraries for extending Client

### RC. *Going Silver*
- [ ] Must first complete Beta Checklist
- [ ] Working equivelent of all current features in production app **not listed here**
- [ ] Ability to share and consume "*key resourses*" to and from instances
- [ ] Implement SSO with an open source email client
- [ ] Implement ability to manage auth for Nexcloud server (Supports OAuth2)  


### Release. *Prod 1*
- [ ] Must first complete RC Checklist
- [ ] Unit Tests for equivelent of all current features in production app **not listed here**
- [ ] Deployment Pipelines
- [ ] Openid connect 

### Perpetual Beta. *Rolling Release*

- Perfect Documentation, tutorials, and internal wikis
- Maintain, Implement and Test inflow of new features
- Build and implement in-house, in-app, integrated bug reporter





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
