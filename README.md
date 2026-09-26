# Task Manager

A simple Laravel-based task management application built as a technical evaluation task. Users can create, edit, and manage their own tasks, while Admins can view and manage all tasks across every user.

## Tech Stack

- Laravel 13
- Laravel Breeze (Blade + Alpine.js) for authentication
- MySQL
- Tailwind CSS

## Features

- User authentication (register/login) via Laravel Breeze
- Role-based access control (Admin / User) via middleware
- Full CRUD on Tasks with validation
- Admins can view and manage all users' tasks
- Regular users can only view and manage their own tasks
- Search and pagination on the task list
- Sidebar dashboard layout

## Setup Instructions

1. Clone the repository:

- git clone <your-repo-url>
- cd task-manager

2. Install PHP dependencies:

- composer install

3. Install JS dependencies and build assets:

- npm install
- npm run build

4. Copy the environment file and generate an app key:

- cp .env.example .env
- php artisan key:generate

5. Create a MySQL database and update your .env file with your database credentials:

- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=your_database_name
- DB_USERNAME=your_username
- DB_PASSWORD=your_password

6. Run migrations and seed the database:

- php artisan migrate --seed

7. Serve the application:

- php artisan serve

## Test Accounts

After seeding, log in with:

**Admin**

- Email: `admin@example.com`
- Password: `password`

Or register a new account to test the regular User role (new accounts default to "user").
