# Ticket Recording System

### Project Setup

1. install the dependencies

```shell
composer install
```

2. Copy `.env.example` to `.env`

```shell
cp .env.example .env
```

3. Generate application key

```shell
php artisan key:generate
```

4. Start the webserver

```shell
php artisan serve
```

## Database Migration and Seeding

Open your `.env` file and change the DATABASE options. You can start with SQLite by following these steps

1. Create a new MySQL database named `ticket_recording_system`

2. you can run migrations to create database tables

```shell
php artisan migrate
```


### Admin Account
1. go to localhost/admin/auth/login
2. The default admin email is "admin" and the default password is "admin".

