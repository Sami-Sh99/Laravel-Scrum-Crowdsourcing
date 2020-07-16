<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

# About Project

## Motivation
‘25/10 Crowd Sourcing’ is a structure that allows you to rapidly generate and sift through a group’s boldest actionable ideas in less than 30 minutes. We’ve applied this structure both to small (12–20 members) and large groups (>150). Not only is it an innovative way to identify bold, ‘out of the box’-solutions, it is also appreciated by participants for its highly active nature.
This project proposes a digital solution to enable distributed teams to benefit from the crowd sourcing structure, with unlimited number of participants and from all around the globe.

- [Read this article](https://medium.com/the-liberators/use-25-10-crowd-sourcing-to-spice-up-your-scrum-events-56fdd127e1dc) for more info about Crowd Sourcing.

## Screenshots

![Alt text](/demo/t.png?raw=true "HomeScreen")

![Alt text](/demo/login.jpg?raw=true "LoginScreen")

![Alt text](/demo/workshop-dashboard.jpg?raw=true "HomeScreen")

![Alt text](/demo/rate-card.jpg?raw=true "HomeScreen")

![Alt text](/demo/submit-card.jpg?raw=true "HomeScreen")



## Demo

The following video showcases the 25/10 Crowd-Sourcing process using our web app:

https://drive.google.com/file/d/16Gf4Np50tqdDe8dBnktDQfUER887aERu/view?usp=sharing




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

## License

The Laravel **Project Name** is licensed under the [MIT license](http://opensource.org/licenses/MIT).

## Thanks

### Main Team Contributor: [@Hkataya](https://github.com/Hkataya) 

- [Laravel PHP Framework](https://github.com/laravel/laravel)

- [Pusher.js](https://github.com/pusher/pusher-js)
