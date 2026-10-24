# Laravel + Filament

A Laravel application with a Filament 5 admin panel.

## Requirements

- PHP 8.3 or later
- Composer
- Node.js and npm (for frontend assets)
- PHP `pdo_sqlite` extension (for the default SQLite database)

## Setup

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate
```

The default configuration uses SQLite. Ensure `database/database.sqlite` exists before migrating; Laravel's setup script creates it automatically.

Create a user who can sign in to the admin panel:

```bash
php artisan make:filament-user
```

## Run locally

```bash
composer run dev
```

Open [http://localhost:8000/admin](http://localhost:8000/admin) and sign in with the user created above.

## Filament resources

Generate a resource with:

```bash
php artisan make:filament-resource ResourceName
```

Resources and custom pages are discovered from `app/Filament`.
