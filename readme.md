<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

# About Project

## Motivation
‘25/10 Crowd Sourcing’ is a structure that allows you to rapidly generate and sift through a group’s boldest actionable ideas in less than 30 minutes. We’ve applied this structure both to small (12–20 members) and large groups (>150). Not only is it an innovative way to identify bold, ‘out of the box’-solutions, it is also appreciated by participants for its highly active nature.
This project proposes a digital solution to enable distributed teams to benefit from the crowd sourcing structure, with unlimited number of participants and from all around the globe.

- [Read this article](https://medium.com/the-liberators/use-25-10-crowd-sourcing-to-spice-up-your-scrum-events-56fdd127e1dc) for more info about Crowd Sourcing.

## Usage



## Setup

### Git Clone

```
$ git clone git@github.com:Sami-Sh99/Laravel-Scrum-Crowdsourcing.git
$ cd Laravel-Scrum-Crowdsourcing
$ composer install
```

**Important**: If you have not the .env file in root folder, you must copy or rename the .env.example to .env

```
php artisan key:generate
```
#### Database

.env file

```
DB_CONNECTION=mysql
DB_HOST=XXXXXX
DB_PORT=3306
DB_DATABASE=XXXXX
DB_USERNAME=XXXX
DB_PASSWORD=XXXXX
```

**Remember**: Create the database before run artisan command.

```
php artisan migrate
```
#### Pusher Broadcast
[Create a Pusher account](https://dashboard.pusher.com/accounts), then create a Channels app. Go to the **Keys** page for that app, and make a note of your *_app_id_*, *_key_*, *_secret_*.
.env file
```
PUSHER_APP_ID=XXXX
PUSHER_APP_KEY=XXXXXXXX
PUSHER_APP_SECRET=XXXXXXXX
```

## Contributing

PRs and issues are welcome. In addition to the issue section we have a [Trello board](https://trello.com/b/rrlSUI0h/laravel-scrum-system) listing things that need to be done.

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel **Project Name** is licensed under the [MIT license](http://opensource.org/licenses/MIT).

## Thanks

### Main Team Contributor: [@Hkataya](https://github.com/Hkataya) 

- [Laravel PHP Framework](https://github.com/laravel/laravel)

- [Pusher.js](https://github.com/pusher/pusher-js)