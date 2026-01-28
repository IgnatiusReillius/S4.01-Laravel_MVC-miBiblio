## miBiblio – Book Management Application

A Laravel-based application for managing a personal library, wich the user can add also custom information for each book.
(As this is my first web application, the database is quite limited. It only works with books by Isaac Asimov and Cixin Liu!)

## Features

- User registration and authentication
- Book CRUD
- Add personal reviews to your books
- Filtering and sorting

## Prerequisites

Before cloning the project, ensure the following tools are installed:

- **[Git](https://git-scm.com/install/windows)**
- **[PHP via XAMPP](https://codersfree.com/posts/como-instalar-php-en-windows-usando-xampp)**
- **[Composer](https://getcomposer.org/download/)**
- **[Node.js & npm](https://nodejs.org/es/download)**

## Installation

### 1. Clone the repository
```
git clone https://github.com/IgnatiusReillius/S4.01-Laravel_MVC-miBiblio.git
cd S4.01-Laravel_MVC-miBiblio
```

### 2. Install PHP dependencies
```
composer install
```

### 3. Install Node.js dependencies
```
npm install
```

### 4. Create your environment file
```
cp .env.example .env
```

### 5. Generate the application key
```
php artisan key:generate
```

## Environment Configuration

Make sure your `/.env` file contains the following:
```
APP_ENV=local
APP_DEBUG=true

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=miBiblio
DB_USERNAME=root
DB_PASSWORD=
```

## Run Migrations and Seeders

This will rebuild your database and load initial data:
```
php artisan migrate --seed
```

## Start the Development Servers

```
php artisan serve
```

This command will return a message similar to:

```
Server running on [http://127.0.0.1:8000].
```

With this URL, you will be able to access the application.
Then, in a new terminal:

```
cd S4.01-Laravel_MVC-miBiblio
npm run dev
```

## Testing the Application

You can register a new user, or log in with one of the seeded test accounts:

- fibyj@mailinator.com - Pa$$w0rd!
- mydomub@mailinator.com - Pa$$w0rd!

## License

This project is for educational purposes and part of the IT Academy exercises.
